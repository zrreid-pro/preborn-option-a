<?php

namespace App\Models;

use App\Enums\CampaignStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name', 'goal_amount', 'starts_at', 'ends_at'];

    protected $casts = [
        'status' => CampaignStatus::class,
    ];

    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory;

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
