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
        return $this->hasManyThrough(User::class, Team::class, 'organization_id', 'id', 'id', 'user_id')
                    ->join('team_user', 'users.id', '=', 'team_user.user_id')
                    ->join('teams', 'team_user.team_id', '=', 'teams.id')
                    ->where('teams.organization_id', $this->id)
                    ->distinct();
    }
}
