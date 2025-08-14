<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    /**
     * Show the landing page with marketing content.
     */
    public function index()
    {
        return view('landing.index');
    }

    /**
     * Show the company registration page.
     */
    public function register()
    {
        return view('landing.register');
    }

    /**
     * Handle company registration.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'organization_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Create the user (organization owner) - always as client
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'client',
            ]);

            // Create the organization
            $organization = Organization::create([
                'name' => $request->organization_name,
                'owner_id' => $user->id,
            ]);

            // Create the default team
            $team = Team::create([
                'name' => 'Main Team',
                'organization_id' => $organization->id,
            ]);

            // Add the user as owner of the team
            $team->users()->attach($user->id, ['role' => 'owner']);

            DB::commit();

            // Log the user in
            Auth::login($user);

            // Redirect to company dashboard
            return redirect()->route('filament.company.pages.dashboard');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log the actual error for debugging
            Log::error('Registration failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the login page with options for admin/company.
     */
    public function login()
    {
        return view('landing.login');
    }

    /**
     * Handle login and redirect to appropriate dashboard.
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Route based on user role
            if ($user->role === 'super_admin') {
                return redirect()->route('filament.admin.pages.dashboard');
            } else {
                return redirect()->route('filament.company.pages.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }


}
