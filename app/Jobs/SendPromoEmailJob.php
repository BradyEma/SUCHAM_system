<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPromoEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $cluster;

    public function __construct($email, $cluster)
    {
        $this->email = $email;
        $this->cluster = $cluster;
    }

    public function handle()
    {
        Mail::raw("🎉 Exclusive offer for you in Cluster {$this->cluster}! Check out our new sugar deals.", function ($msg) {
            $msg->to($this->email)->subject('Special Offer from SUCHAM!');
        });
    }
}
