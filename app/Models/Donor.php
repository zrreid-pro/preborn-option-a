<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [ 'name', 'email', 'phone_number' ];

    /** @use HasFactory<\Database\Factories\DonorFactory> */
    use HasFactory;

    public function donations() {
        return $this->hasMany(Donation::class);
    }
}
