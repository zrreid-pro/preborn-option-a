<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

use App\Http\Controllers\CampaignController;

class CampaignTotalUpdateJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue;

    private $campaign_id;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->campaign_id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        CampaignController::updateCurrentTotal($this->campaign_id);
    }
}
