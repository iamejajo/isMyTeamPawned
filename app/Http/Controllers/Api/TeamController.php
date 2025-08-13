<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Invite a member to a team.
     */
    public function invite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
            'email' => 'required|email',
            'role' => 'required|in:admin,member',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $team = Team::findOrFail($request->team_id);
        $user = $request->user();

        // Check if user has permission to invite to this team
        $userRole = $team->users()->where('user_id', $user->id)->first();

        if (!$userRole || !in_array($userRole->pivot->role, ['owner', 'admin'])) {
            return response()->json([
                'message' => 'You do not have permission to invite members to this team'
            ], 403);
        }

        // Check if user is already a member
        $existingMember = $team->users()->where('email', $request->email)->first();
        if ($existingMember) {
            return response()->json([
                'message' => 'User is already a member of this team'
            ], 400);
        }

        // Check if there's already a pending invitation
        $existingInvitation = $team->invitations()
            ->where('email', $request->email)
            ->where('accepted_at', null)
            ->where('expires_at', '>', now())
            ->first();

        if ($existingInvitation) {
            return response()->json([
                'message' => 'User already has a pending invitation to this team'
            ], 400);
        }

        // Create invitation
        $invitation = Invitation::create([
            'team_id' => $team->id,
            'email' => $request->email,
            'role' => $request->role,
            'token' => Invitation::generateToken(),
            'expires_at' => now()->addDays(7), // Invitation expires in 7 days
        ]);

        // TODO: Send invitation email (implement later with queue job)
        // For now, just return success

        return response()->json([
            'message' => 'Invitation sent successfully',
            'invitation' => $invitation,
            'team' => $team->load('users')
        ]);
    }

    /**
     * Get team members.
     */
    public function members(Request $request, Team $team)
    {
        $user = $request->user();

        // Check if user has access to this team
        $userRole = $team->users()->where('user_id', $user->id)->first();

        if (!$userRole) {
            return response()->json([
                'message' => 'You do not have access to this team'
            ], 403);
        }

        return response()->json([
            'team' => $team->load(['users', 'organization']),
            'user_role' => $userRole->pivot->role
        ]);
    }

    /**
     * Remove member from team.
     */
    public function removeMember(Request $request, Team $team)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $userRole = $team->users()->where('user_id', $user->id)->first();

        // Check permissions
        if (!$userRole || !in_array($userRole->pivot->role, ['owner', 'admin'])) {
            return response()->json([
                'message' => 'You do not have permission to remove members from this team'
            ], 403);
        }

        // Cannot remove the team owner
        $memberToRemove = $team->users()->where('user_id', $request->user_id)->first();
        if ($memberToRemove && $memberToRemove->pivot->role === 'owner') {
            return response()->json([
                'message' => 'Cannot remove the team owner'
            ], 400);
        }

        // Remove user from team
        $team->users()->detach($request->user_id);

        return response()->json([
            'message' => 'Member removed successfully'
        ]);
    }

    /**
     * Update member role.
     */
    public function updateMemberRole(Request $request, Team $team)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:owner,admin,member',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $userRole = $team->users()->where('user_id', $user->id)->first();

        // Only team owner can change roles
        if (!$userRole || $userRole->pivot->role !== 'owner') {
            return response()->json([
                'message' => 'Only team owner can change member roles'
            ], 403);
        }

        // Update role
        $team->users()->updateExistingPivot($request->user_id, [
            'role' => $request->role
        ]);

        return response()->json([
            'message' => 'Member role updated successfully'
        ]);
    }
}
