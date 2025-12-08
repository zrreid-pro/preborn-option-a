<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index() {
        // Gets all the Campaigns
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return $campaigns;
    }

    public function show($id) {
        // Gets a specific Campaign
        $campaign = Campaign::findOrFail($id);
        return $campaign;
    }

    public function create($campaign) {
        // Creates a new Campaign from the campaign object provided
    }

    public function update($id) {
        // Updates a specific Campaign
    }

    public function delete($id) {
        // Deletes a specific Campaign
    }
}
