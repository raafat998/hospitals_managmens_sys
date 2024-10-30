<?php
// app/Mail/StatusChanged.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $property;

    public function __construct($property)
    {
        $this->property = $property;
    }

    public function build()
    {
        return $this->view('emails.status_changed')
                    ->with([
                        'propertyName' => $this->property->property_name,
                        'status' => $this->property->status,
                    ]);
    }
}
