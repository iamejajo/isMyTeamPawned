<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreachEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitor_id',
        'breach_name',
        'breach_date',
        'data_classes',
        'description',
        'source',
        'added_at',
        'is_new',
    ];

    protected $casts = [
        'breach_date' => 'date',
        'data_classes' => 'array',
        'added_at' => 'datetime',
        'is_new' => 'boolean',
    ];

    public function monitor()
    {
        return $this->belongsTo(Monitor::class);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeBySource($query, $source)
    {
        return $query->where('source', $source);
    }

    public function markAsSeen()
    {
        $this->update(['is_new' => false]);
    }

    public function getDataClassesListAttribute()
    {
        return is_array($this->data_classes) ? $this->data_classes : [];
    }
}
