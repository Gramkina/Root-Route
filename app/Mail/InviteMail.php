<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable{
    use Queueable, SerializesModels;

    protected $code;

    public function __construct($code){
        $this->code = $code;
    }

    public function build(){
        return $this->view('mails.invite', ['code' => $this->code]);
    }
}
