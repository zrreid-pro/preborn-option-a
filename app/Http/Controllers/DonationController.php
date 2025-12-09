<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

use App\Enums\PaymentMethod;

class DonationController extends Controller
{
    public function index() {
        // Gets all the Donations
        $donations = Donation::with([ 'donor', 'campaign' ])->orderBy('id', 'desc')->paginate(10);
        return $donations;
    }

    public function getTotalDonationsByDonor($donor_id) {
        // Gets total Donations made by the Donor with the provided id
    }

    public function getTotalDonationsByCampaign($campaign_id) {
        // Gets total Donations made to the Campaign with the provided id
    }

    public function create($donation) {
        // Creates a new Donation from the donation object provided
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'amount' => 'required|integer',
            'method_enum' => new Enum(PaymentMethod::class),
            'received_at' => 'required|dateTime'
        ]);
    }

}
