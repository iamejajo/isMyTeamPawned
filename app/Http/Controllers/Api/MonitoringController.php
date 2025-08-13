<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monitor;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonitoringController extends Controller
{
    /**
     * Add a new monitor to a team.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
            'type' => 'required|in:email,domain',
            'value' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $team = Team::findOrFail($request->team_id);

        // Check if user has access to this team
        $userRole = $team->users()->where('user_id', $user->id)->first();
        if (!$userRole) {
            return response()->json(['message' => 'You do not have access to this team'], 403);
        }

        // Check if user has permission to add monitors (owner, admin, or member)
        if (!in_array($userRole->pivot->role, ['owner', 'admin'])) {
            return response()->json(['message' => 'You do not have permission to add monitors to this team'], 403);
        }

        // Validate email/domain format
        if ($request->type === 'email' && !filter_var($request->value, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['message' => 'Invalid email format'], 422);
        }

        //TODO domain scanning require validation of domain ownership - i'll do this on v2
        if ($request->type === 'domain' && !filter_var($request->value, FILTER_VALIDATE_DOMAIN)) {
            return response()->json(['message' => 'Invalid domain format'], 422);
        }

        // Check if monitor already exists for this team
        $existingMonitor = $team->monitors()->where('value', $request->value)->first();
        if ($existingMonitor) {
            return response()->json(['message' => 'This email/domain is already being monitored by your team'], 422);
        }

        // Create the monitor
        $monitor = $team->monitors()->create([
            'type' => $request->type,
            'value' => $request->value,
            'notes' => $request->notes,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Monitor added successfully',
            'monitor' => $monitor->load('team')
        ], 201);
    }

    /**
     * List all monitors for a team.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
            'type' => 'nullable|in:email,domain',
            'active_only' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $team = Team::findOrFail($request->team_id);

        // Check if user has access to this team
        $userRole = $team->users()->where('user_id', $user->id)->first();
        if (!$userRole) {
            return response()->json(['message' => 'You do not have access to this team'], 403);
        }

        $query = $team->monitors()->with(['breachEvents' => function ($query) {
            $query->new()->orderBy('breach_date', 'desc');
        }]);

        // Filter by type if specified
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by active status if specified
        if ($request->has('active_only')) {
            $query->where('is_active', $request->boolean('active_only'));
        }

        $monitors = $query->orderBy('created_at', 'desc')->get();

        // Add breach count to each monitor
        $monitors->each(function ($monitor) {
            $monitor->breach_count = $monitor->breachEvents->count();
            $monitor->new_breach_count = $monitor->breachEvents->where('is_new', true)->count();
        });

        return response()->json([
            'monitors' => $monitors,
            'team' => $team->load('organization'),
            'user_role' => $userRole->pivot->role,
        ]);
    }

    /**
     * Remove a monitor.
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $monitor = Monitor::with('team')->findOrFail($id);

        // Check if user has access to the team that owns this monitor
        $userRole = $monitor->team->users()->where('user_id', $user->id)->first();
        if (!$userRole) {
            return response()->json(['message' => 'You do not have access to this monitor'], 403);
        }

        // Check if user has permission to remove monitors (owner or admin only)
        if (!in_array($userRole->pivot->role, ['owner', 'admin'])) {
            return response()->json(['message' => 'You do not have permission to remove monitors from this team'], 403);
        }

        $monitor->delete();

        return response()->json(['message' => 'Monitor removed successfully']);
    }

    /**
     * Update a monitor (toggle active status, update notes).
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'is_active' => 'nullable|boolean',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $monitor = Monitor::with('team')->findOrFail($id);

        // Check if user has access to the team that owns this monitor
        $userRole = $monitor->team->users()->where('user_id', $user->id)->first();
        if (!$userRole) {
            return response()->json(['message' => 'You do not have access to this monitor'], 403);
        }

        // Check if user has permission to update monitors (owner, admin, or member)
        if (!in_array($userRole->pivot->role, ['owner', 'admin'])) {
            return response()->json(['message' => 'You do not have permission to update monitors in this team'], 403);
        }

        $monitor->update($request->only(['is_active', 'notes']));

        return response()->json([
            'message' => 'Monitor updated successfully',
            'monitor' => $monitor->load('team')
        ]);
    }

    /**
     * Get monitor statistics for a team.
     */
    public function stats(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $team = Team::findOrFail($request->team_id);

        // Check if user has access to this team
        $userRole = $team->users()->where('user_id', $user->id)->first();
        if (!$userRole) {
            return response()->json(['message' => 'You do not have access to this team'], 403);
        }

        $monitors = $team->monitors();
        $activeMonitors = $team->activeMonitors();

        $stats = [
            'total_monitors' => $monitors->count(),
            'active_monitors' => $activeMonitors->count(),
            'email_monitors' => $monitors->where('type', 'email')->count(),
            'domain_monitors' => $monitors->where('type', 'domain')->count(),
            'total_breaches' => $team->monitors()->withCount('breachEvents')->get()->sum('breach_events_count'),
            'new_breaches' => $team->monitors()->withCount(['breachEvents as new_breach_events_count' => function ($query) {
                $query->where('is_new', true);
            }])->get()->sum('new_breach_events_count'),
            'last_scan' => $activeMonitors->max('last_scanned_at'),
        ];

        return response()->json([
            'stats' => $stats,
            'team' => $team->load('organization'),
        ]);
    }
}
