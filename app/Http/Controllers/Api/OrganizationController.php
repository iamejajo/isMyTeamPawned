<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    /**
     * Create a new organization and initial team.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'team_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create organization
            $organization = Organization::create([
                'name' => $request->name,
                'owner_id' => $request->user()->id,
            ]);

            // Create initial team
            $team = Team::create([
                'name' => $request->team_name,
                'organization_id' => $organization->id,
            ]);

            // Add user to team as owner
            $team->users()->attach($request->user()->id, [
                'role' => 'owner'
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Organization and team created successfully',
                'organization' => $organization->load('teams'),
                'team' => $team->load('users')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create organization',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's organizations.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $organizations = $user->ownedOrganizations()->with(['teams.users'])->get();

        // Also get organizations where user is a member through teams
        $memberOrganizations = $user->organizations()->with(['teams.users'])->get();

        return response()->json([
            'owned_organizations' => $organizations,
            'member_organizations' => $memberOrganizations
        ]);
    }

    /**
     * Get specific organization.
     */
    public function show(Request $request, Organization $organization)
    {
        // Check if user has access to this organization
        $user = $request->user();

        if ($organization->owner_id !== $user->id &&
            !$organization->teams()->whereHas('users', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->exists()) {
            return response()->json([
                'message' => 'Unauthorized access to organization'
            ], 403);
        }

        return response()->json([
            'organization' => $organization->load(['teams.users', 'owner'])
        ]);
    }
}
