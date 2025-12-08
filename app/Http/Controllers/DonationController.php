<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index() {
        // Gets all the Donations
        $donations = Donation::with([ 'donor', 'campaign' ])->orderBy('id', 'desc')->get();
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

}
