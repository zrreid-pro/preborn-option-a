<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

use App\Enums\PaymentMethod;
use App\Enums\CampaignStatus;
use App\Enums\EventType;
use App\Http\Controllers\EventLogController;
use App\Jobs\CampaignTotalUpdateJob;

class DonationController extends Controller
{
    public function index() {
        // Gets all the Donations
        $donations = Donation::with([ 'donor', 'campaign' ])->orderBy('id', 'desc')->paginate(10);
        return $donations;
    }

    public function show($id) {
        // Gets a specific Donation
        $donation = Donation::findOrFail($id);
        return $donation;
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
                'amount' => 'required|integer|min:1',
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
                CampaignTotalUpdateJob::dispatch($request->campaign_id);
            }

            // Returns the latest Donation
            $newDonation = Donation::where('donor_id', $request->get('donor_id'))->orderBy('created_at', 'desc')->first();

            // Log Event to table
            EventLogController::logEvent($newDonation->id, EventType::CREATE);

            return $newDonation;
        } catch(\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function update($id, Request $request) {
        // Updates a specific Donation
        try {
            $oldDonation = Donation::find($id);
            $oldCampaignId = $oldDonation->campaign_id;
            $request->validate([
                'donor_id' => 'nullable|exists:donors,id',
                'campaign_id' => 'nullable|exists:campaigns,id',
                'amount' => 'nullable|integer|min:1',
                'method_enum' => ['nullable', new Enum(PaymentMethod::class)],
                'received_at' => 'nullable|date|after_or_equal:today'
            ]);
            // It will only update the values it receives
            if($request->donor_id) {
                $oldDonation->donor_id = $request->donor_id;
            }
            if($request->campaign_id) {
                $oldDonation->campaign_id = $request->campaign_id;
            }
            if($request->amount) {
                $oldDonation->amount = $request->amount;
            }
            if($request->method_enum) {
                $oldDonation->method_enum = $request->method_enum;
            }
            if($request->received_at) {
                $oldDonation->received_at = $request->received_at;
            }

            $oldDonation->save();

            // Queue a job to recalculate the Campaign's current total if it was attached to a Campaign
            if($oldDonation->campaign_id) {
                if($request->campaign_id !== $oldCampaignId) {
                    // If the campaign_id changed, both the old and the new Campaign totals need to be updated
                    CampaignTotalUpdateJob::dispatch($request->campaign_id);
                    CampaignTotalUpdateJob::dispatch($oldCampaignId);
                } else {
                    CampaignTotalUpdateJob::dispatch($oldDonation->campaign_id);
                }
            }

            
            // Log Event to table
            EventLogController::logEvent($oldDonation->id, EventType::UPDATE);

            return $oldDonation;
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
            CampaignTotalUpdateJob::dispatch($donation->campaign_id);
        }

        // Log Event to table
        EventLogController::logEvent($id, EventType::DELETE);

        $donation->delete();
        return 'Donation Deleted';
    }
}
