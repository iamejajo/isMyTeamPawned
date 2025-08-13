<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Monitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'type',
        'value',
        'last_scanned_at',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'last_scanned_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function breachEvents()
    {
        return $this->hasMany(BreachEvent::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeNeedsScanning($query)
    {
        return $query->where('is_active', true)
                    ->where(function ($q) {
                        $q->whereNull('last_scanned_at')
                          ->orWhere('last_scanned_at', '<', now()->subDay());
                    });
    }

    public function markAsScanned()
    {
        $this->update(['last_scanned_at' => now()]);
    }

    public function isEmail(): bool
    {
        return $this->type === 'email';
    }

    public function isDomain(): bool
    {
        return $this->type === 'domain';
    }

    public static function getValidationRules($teamId = null)
    {
        return [
            'type' => ['required', Rule::in(['email', 'domain'])],
            'value' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (request('type') === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('The value must be a valid email address.');
                    }
                    if (request('type') === 'domain' && !filter_var($value, FILTER_VALIDATE_DOMAIN)) {
                        $fail('The value must be a valid domain.');
                    }
                },
                function ($attribute, $value, $fail) use ($teamId) {
                    if ($teamId && static::where('team_id', $teamId)
                        ->where('value', $value)
                        ->exists()) {
                        $fail('This email/domain is already being monitored by your team.');
                    }
                }
            ],
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
