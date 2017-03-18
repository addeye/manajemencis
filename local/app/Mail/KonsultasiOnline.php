<?php

namespace App\Mail;

use App\Konsultasi;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KonsultasiOnline extends Mailable
{
    use Queueable, SerializesModels;

    protected $konsultasi;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($konsultasi_id,$user_id)
    {
        $this->konsultasi = Konsultasi::find($konsultasi_id);
        $this->user = User::find($user_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array(
            'konsultasi' => $this->konsultasi,
            'user' => $this->user
        );
        return $this->view('email.konsultasi',$data);
    }
}
