<?php

namespace App\Http\Controllers;

use App\Models\EventLog;
use Illuminate\Http\Request;

class EventLogController extends Controller
{
    public static function logEvent($donation_id, $event_type) {
        // Logs the Donation Event to the database
        EventLog::create([
            'donation_id' => $donation_id,
            'type' => $event_type
        ]);

        return 'Event logged';
    }

    public function index() {
        // Gets the entire Event Log
        $events = EventLog::with('donation')->orderBy('id', 'desc')->paginate(10);
        return $events;
    }
}
