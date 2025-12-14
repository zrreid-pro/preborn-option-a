<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public static function updateCurrentTotal($id) {
        // Updates the current_total field on the provided Campaign
        $campaign = Campaign::withSum('donations', 'amount')->where('id', $id)->first();
        $campaign->current_total = $campaign->donations_sum_amount;
        $campaign->save();
        return $campaign;        
    }

    public function index() {
        // Gets all the Campaigns
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return $campaigns;
    }

    public function show($id) {
        // Gets a specific Campaign
        $campaign = Campaign::find($id);
        return $campaign;
    }

    public function create($campaign) {
        // Returns a form for the user to create a new Campaign
    }

    public function store(Request $request) {
        // Creates a new Campaign from the request provided
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'goal_amount' => 'required|integer|min:0',
                'current_total' => 'required|integer|min:0|max:0',
                'starts_at' => 'required|date',
                'ends_at' => 'required|date|after:starts_at'
            ]);

            Campaign::create($validated);

            // Returns the latest Campaign
            $newCampaign = Campaign::latest()->first();
            return $newCampaign;
        } catch(\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function update($id, Request $request) {
        // Updates a specific Campaign
        try {
            $oldCampaign = Campaign::find($id);
            $request->validate([
                'name' => 'nullable|string|max:255',
                'goal_amount' => 'nullable|integer|min:0',
                'starts_at' => 'nullable|date|before:ends_at',
                'ends_at' => 'nullable|date|after:starts_at'
            ]);

            // It will only update the values it receives
            if($request->name) {
                $oldCampaign->name = $request->name;
            }
            if($request->goal_amount) {
                $oldCampaign->goal_amount = $request->goal_amount;
            }
            if($request->starts_at) {
                $oldCampaign->starts_at = $request->starts_at;
            }
            if($request->ends_at) {
                $oldCampaign->ends_at = $request->ends_at;
            }

            $oldCampaign->save();

            return $oldCampaign;
        } catch(\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function delete($id) {
        // Deletes a specific Campaign
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();
        return 'Campaign Deleted';
    }

    public function totalDonated($id) {
        // Gets the total donated to the given Campaign
        $campaign = Campaign::find($id);
        return $campaign;
    }
}
