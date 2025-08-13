<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'organization_id',
    ];

    /**
     * Get the organization that owns the team.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the users that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Get the owner of the team (user with 'owner' role).
     */
    public function owner()
    {
        return $this->belongsToMany(User::class, 'team_user')
                    ->withPivot('role')
                    ->wherePivot('role', 'owner')
                    ->first();
    }

    /**
     * Get the admins of the team (users with 'admin' role).
     */
    public function admins()
    {
        return $this->belongsToMany(User::class, 'team_user')
                    ->withPivot('role')
                    ->wherePivot('role', 'admin');
    }

    /**
     * Get the members of the team (users with 'member' role).
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'team_user')
                    ->withPivot('role')
                    ->wherePivot('role', 'member');
    }

    /**
     * Get the pending invitations for this team.
     */
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Get pending invitations for this team.
     */
    public function pendingInvitations()
    {
        return $this->invitations()->where('accepted_at', null)->where('expires_at', '>', now());
    }

    /**
     * Get the monitors for this team.
     */
    public function monitors()
    {
        return $this->hasMany(Monitor::class);
    }

    /**
     * Get active monitors for this team.
     */
    public function activeMonitors()
    {
        return $this->monitors()->where('is_active', true);
    }
}
