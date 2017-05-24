<?php

namespace App\Mail;

use App\Konsultan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KonsultasiAlert extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idkonsultasi)
    {
        $this->data = Konsultan::find($idkonsultasi);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array(
            'data' => $this->data,
        );
        return $this->view('email.alert_konsultasi',$data);
    }
}
