<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'owner_id',
    ];

    /**
     * Get the owner of the organization.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the teams that belong to the organization.
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Get all users that belong to this organization through teams.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'teams', 'organization_id', 'id')
                    ->join('team_user', 'teams.id', '=', 'team_user.team_id')
                    ->where('team_user.user_id', 'users.id')
                    ->distinct();
    }

    /**
     * Get the total number of users across all teams in this organization.
     */
    public function getTotalUsersCountAttribute()
    {
        return $this->teams->sum(function ($team) {
            return $team->users->count();
        });
    }
}
