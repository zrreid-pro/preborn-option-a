<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index() {
        // Gets all the Donors
        $donors = Donor::orderBy('created_at', 'desc')->paginate(10);
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
        // Creates a new Donor from the request provided
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:donors',
                'phone_number' => 'nullable|string'
            ]);

            Donor::create($validated);

            // Returns the latest Donor
            $newDonor = Donor::latest()->first();
            return $newDonor;
        } catch(\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function update($id, Request $request) {
        // Updates a specific Donor
        try {
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|unique:donors',
                'phone_number' => 'nullable|string'
            ]);

            $oldDonor = Donor::find($id);

            // It will only update the values it receives
            if($request->name) {
                $oldDonor->name = $request->name;
            }
            if($request->email) {
                $oldDonor->email = $request->email;
            }
            if($request->phone_number) {
                $oldDonor->phone_number = $request->phone_number;
            }

            $oldDonor->save();

            return $oldDonor;

        } catch(\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function delete($id) {
        // Deletes a specific Donor
        $donor = Donor::findOrFail($id);
        $donor->delete();
        return 'Donor Deleted';
    }

    public function topFiveLastThirtyDays() {
        // Gets top 5 Donors from last 30 days
        $donors = Donor::whereHas('donations', function($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            })->withSum(['donations' => function($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            }], 'amount')->orderBy('donations_sum_amount', 'desc')->take(5)->get();
        return $donors;
    }
}
