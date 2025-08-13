<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\TeamController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/register/owner', [AuthController::class, 'registerAsOwner']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/invitations/accept', [AuthController::class, 'acceptInvitation']);
    Route::get('/invitations/pending', [AuthController::class, 'pendingInvitations']);

    // Organization routes
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::get('/organizations/{organization}', [OrganizationController::class, 'show']);

    // Team routes
    Route::post('/teams/invite', [TeamController::class, 'invite']);
    Route::get('/teams/{team}/members', [TeamController::class, 'members']);
    Route::delete('/teams/{team}/members', [TeamController::class, 'removeMember']);
    Route::patch('/teams/{team}/members/role', [TeamController::class, 'updateMemberRole']);
});
