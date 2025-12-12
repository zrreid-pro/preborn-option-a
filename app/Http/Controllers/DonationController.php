<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

use App\Enums\PaymentMethod;
use App\Enums\CampaignStatus;

class DonationController extends Controller
{
    public function index() {
        // Gets all the Donations
        $donations = Donation::with([ 'donor', 'campaign' ])->orderBy('id', 'desc')->paginate(10);
        // $donations = Donation::orderBy('created_at', 'desc')->paginate(10);
        return $donations;
    }

    public function show($id) {
        // Gets a specific Donation
        $donation = Donation::findOrFail($id);
        return $donation;
    }

    public function getTotalDonationsByDonor() {
        // Gets total Donations grouped by Donor in last 30 days
        $donors = Donation::where('created_at', '>=', now()->subDays(30))->get();
        return $donors;
    }

    public function getTotalDonationsByCampaign($campaign_id) {
        // Gets total Donations made to the Campaign with the provided id
    }

    public function create($donation) {
        // Creates a new Donation from the donation object provided
    }

    public function store(Request $request) {
        // Creates a new Donation from the request provided
        try {
            $validated = $request->validate([
                'donor_id' => 'required|exists:donors,id',
                'campaign_id' => 'nullable|exists:campaigns,id',
                'amount' => 'required|integer',
                'method_enum' => ['required', new Enum(PaymentMethod::class)],
                'received_at' => 'nullable|date|after_or_equal:today'
            ]);
            // Design Choice Note: My interpretation of the received_at field
            //  is that certain methods like CASH or CHECK require time and are't
            //  instantaneous like CARD is so the received_at field would be different
            //  than the created_at timestamp field. Therefore it should be nullable.

            Donation::create($validated);

            // Queue a job to recalculate the Campaign's current total if it was attached to a Campaign
            if($request->campaign_id) {
                // Add update total job to the queue
            }

            // Returns the latest Donation
            $newDonation = Donation::where('donor_id', $request->get('donor_id'))->orderBy('created_at', 'desc')->first();
            return $newDonation;
        } catch(\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function delete($id) {
        // Deletes a specific Donation
        $donation = Donation::findOrFail($id);
        // Queue a job to recalculate the Campaign's current total if it was attached to a Campaign
        if($donation->campaign_id) {
            // Add update total job to the queue
        }

        $donation->delete();
        return 'Donation Deleted';
    }
}
