<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index() {
        // Gets all the Donors
        $donors = Donor::orderBy('created_at', 'desc')->get();
        return $donors;
    }

    public function show($id) {
        // Gets a specific Donor
        $donor = Donor::findOrFail($id);
        return $donor;
    }

    public function create() {
        // Returns a form for the user to create a new Donor
    }

    public function store(Request $request) {
        // Creates a new Donor from the donor object provided
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:donors',
            'phone_number' => 'nullable|string'
        ]);

        Donor::create($validated);

        return 'New donor created.';
        // return response()->json();
    }

    public function update($id) {
        // Updates a specific Donor
    }

    public function delete($id) {
        // Deletes a specific Donor
    }

    public function topFiveLastThirtyDays() {
        // Gets top 5 Donors from last 30 days
    }
}
