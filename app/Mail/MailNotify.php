<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $data = [];
    private $title = [];
    private $cart = [];
    private $email = '';
    private $name = '';
    public function __construct($data,$title,$cart,$email,$name)
    {
        //
        $this->data = $data;
        $this->title = $title;
        $this->cart = $cart;
        $this->email = $email;
        $this->name = $name;
    }

    public function build() {
        return $this->from($this->email,$this->name)
        ->subject($this->title['subject'])
        ->view('emails.index')->with('data',$this->data,'cart',$this->cart);
    }
}
