<?php

namespace App\Http\Controllers;

use App\Enums\CampaignStatus;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public static function updateCurrentTotal($id)
    {
        // Updates the current_total field on the provided Campaign
        $campaign = Campaign::withSum('donations', 'amount')->where('id', $id)->first();
        $campaign->current_total = $campaign->donations_sum_amount;
        $campaign->save();

        return $campaign;
    }

    public static function isActiveWindow($starts_at, $ends_at)
    {
        // Performs a check to see if the current day falls inbetween the two dates provided
        $today = date('Y-m-d');
        if ($starts_at <= $today && $today <= $ends_at) {
            return true;
        } else {
            return false;
        }
    }

    public static function isActive($id)
    {
        // Checks to see if the provided campaign has an active status
        $campaign = Campaign::findOrFail($id);
        if ($campaign->status === CampaignStatus::ACTIVE) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateStatus()
    {
        // Calculates the status of each Campaign and updates the value
        // The complex select query is meant to lower the processing needed by only getting
        //  the records that will be changing
        $today = date('Y-m-d');
        $campaigns = Campaign::where([
            ['status', '=', CampaignStatus::INACTIVE],
            ['starts_at', '<=', $today],
            ['ends_at', '>=', $today],
        ])->orWhere([
            ['status', '=', CampaignStatus::ACTIVE],
            ['ends_at', '<', $today],
        ])->get();

        foreach ($campaigns as $campaign) {
            if ($campaign->starts_at <= $today && $today <= $campaign->ends_at) {
                $campaign->status = CampaignStatus::ACTIVE;
            } else {
                $campaign->status = CampaignStatus::INACTIVE;
            }
            $campaign->save();
        }

        logger('Campaign Status Update');
    }

    public function index()
    {
        // Gets all the Campaigns
        $campaigns = Campaign::orderBy('created_at', 'desc')->paginate(10);

        return view('campaigns.index', ['campaigns' => $campaigns]);
    }

    public function show($id)
    {
        // Gets a specific Campaign
        $campaign = Campaign::find($id);

        return $campaign;
    }

    public function create()
    {
        // Returns a form for the user to create a new Campaign
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        // Creates a new Campaign from the request provided
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'goal_amount' => 'required|integer|min:0',
                'starts_at' => 'required|date',
                'ends_at' => 'required|date|after:starts_at',
            ]);

            $newCampaign = Campaign::create($validated);

            if ($this->isActiveWindow($newCampaign->starts_at, $newCampaign->ends_at)) {
                $newCampaign->status = CampaignStatus::ACTIVE;
            } else {
                $newCampaign->status = CampaignStatus::INACTIVE;
            }
            $newCampaign->save();

            return redirect()->route('campaigns.index');
        } catch (\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function update($id, Request $request)
    {
        // Updates a specific Campaign
        try {
            $oldCampaign = Campaign::find($id);
            $request->validate([
                'name' => 'nullable|string|max:255',
                'goal_amount' => 'nullable|integer|min:0',
                'starts_at' => 'nullable|date|before:ends_at',
                'ends_at' => 'nullable|date|after:starts_at',
            ]);

            // It will only update the values it receives
            if ($request->name) {
                $oldCampaign->name = $request->name;
            }
            if ($request->goal_amount) {
                $oldCampaign->goal_amount = $request->goal_amount;
            }
            if ($request->starts_at) {
                $oldCampaign->starts_at = $request->starts_at;
            }
            if ($request->ends_at) {
                $oldCampaign->ends_at = $request->ends_at;
            }
            if ($request->starts_at || $request->ends_at) {
                if ($this->isActiveWindow($oldCampaign->starts_at, $oldCampaign->ends_at)) {
                    $oldCampaign->status = CampaignStatus::ACTIVE;
                } else {
                    $oldCampaign->status = CampaignStatus::INACTIVE;
                }
            }

            $oldCampaign->save();

            return $oldCampaign;
        } catch (\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function delete($id)
    {
        // Deletes a specific Campaign
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return 'Campaign Deleted';
    }

    public function totalDonatedPerCampaign()
    {
        // Gets the total donated per Campaign
        $campaigns = Campaign::paginate(10, ['id', 'name', 'goal_amount', 'current_total', 'status', 'starts_at', 'ends_at']);

        return $campaigns;
    }
}
