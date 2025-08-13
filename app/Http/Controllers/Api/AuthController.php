<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Register a new user (only allowed if they have pending invitations).
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user has pending invitations
        $pendingInvitations = Invitation::where('email', $request->email)
            ->where('accepted_at', null)
            ->where('expires_at', '>', now())
            ->get();

        if ($pendingInvitations->isEmpty()) {
            return response()->json([
                'message' => 'Registration is only allowed for invited users. Please contact your team administrator for an invitation.',
                'error' => 'no_invitations'
            ], 403);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Accept all pending invitations
            $acceptedInvitations = [];
            foreach ($pendingInvitations as $invitation) {
                // Add user to team
                $invitation->team->users()->attach($user->id, [
                    'role' => $invitation->role
                ]);

                // Mark invitation as accepted
                $invitation->update(['accepted_at' => now()]);

                $acceptedInvitations[] = [
                    'team_name' => $invitation->team->name,
                    'organization_name' => $invitation->team->organization->name,
                    'role' => $invitation->role
                ];
            }

            DB::commit();

            $token = $user->createToken('auth_token')->plainTextToken;

            $response = [
                'message' => 'User registered successfully and joined invited teams',
                'user' => $user,
                'token' => $token,
                'accepted_invitations' => $acceptedInvitations
            ];

            return response()->json($response, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login user and create token.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * Logout user (revoke token).
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Get authenticated user.
     */
    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    /**
     * Accept an invitation.
     */
    public function acceptInvitation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $invitation = Invitation::where('token', $request->token)
            ->where('accepted_at', null)
            ->where('expires_at', '>', now())
            ->first();

        if (!$invitation) {
            return response()->json([
                'message' => 'Invalid or expired invitation'
            ], 404);
        }

        $user = $request->user();

        // Check if user email matches invitation email
        if ($user->email !== $invitation->email) {
            return response()->json([
                'message' => 'This invitation is for a different email address'
            ], 403);
        }

        try {
            DB::beginTransaction();

            // Add user to team
            $invitation->team->users()->attach($user->id, [
                'role' => $invitation->role
            ]);

            // Mark invitation as accepted
            $invitation->update(['accepted_at' => now()]);

            DB::commit();

            return response()->json([
                'message' => 'Invitation accepted successfully',
                'team' => $invitation->team->load('organization'),
                'role' => $invitation->role
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to accept invitation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

        /**
     * Get pending invitations for the authenticated user.
     */
    public function pendingInvitations(Request $request)
    {
        $user = $request->user();

        $invitations = Invitation::where('email', $user->email)
            ->where('accepted_at', null)
            ->where('expires_at', '>', now())
            ->with(['team.organization'])
            ->get();

        return response()->json([
            'invitations' => $invitations
        ]);
    }

    /**
     * Register as organization owner (for first-time organization creators).
     */
    public function registerAsOwner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Organization owner registered successfully',
                'user' => $user,
                'token' => $token,
                'note' => 'You can now create your organization and invite team members'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
