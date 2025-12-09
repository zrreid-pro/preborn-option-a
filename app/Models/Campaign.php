<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\CampaignStatus;

class Campaign extends Model
{
    protected $fillable = [ 'name', 'goal_amount', 'current_total', 'starts_at', 'ends_at' ];
    protected $casts = [
        'status' => CampaignStatus::class
    ];

    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory;

    public function donations() {
        return $this->hasMany(Donation::class);
    }
}
