<?php

namespace App\Jobs;

use App\Http\Controllers\CampaignController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;

class CampaignTotalUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

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
