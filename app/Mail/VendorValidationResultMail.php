<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorValidationResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supplierName;
    public $result;
    public $criteria;
    public $visitDate; // <-- add this

    public function __construct($supplierName, $result, $criteria = [], $visitDate = null)
    {
        $this->supplierName = $supplierName;
        $this->result = $result;
        $this->criteria = $criteria;
        $this->visitDate = $visitDate;
    }

    public function build()
    {
        return $this->subject('Your Vendor Validation Result')
                    ->view('emails.vendor-validation-result');
    }
}

