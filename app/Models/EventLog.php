<?php

namespace App\Models;

use App\Enums\EventType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    protected $fillable = [ 'donation_id', 'type' ];
    protected $casts = [
        'type' => EventType::class
    ];

    /** @use HasFactory<\Database\Factories\EventLogFactory> */
    use HasFactory;

    public function donation() {
        return $this->belongsTo(Donation::class);
    }
}
