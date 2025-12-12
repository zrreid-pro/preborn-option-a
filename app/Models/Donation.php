<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\PaymentMethod;

class Donation extends Model
{
    protected $fillable = [ 'donor_id', 'campaign_id', 'amount', 'method_enum', 'received_at' ];
    protected $casts = [
        'method_enum' => PaymentMethod::class
    ];

    /** @use HasFactory<\Database\Factories\DonationFactory> */
    use HasFactory;

    public function donor() {
        return $this->belongsTo(Donor::class);
    }

    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
}
