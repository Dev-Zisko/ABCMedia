<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Contact;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contact = Contact::All()->last();
        $nom = $contact->nombre;
        $cor = $contact->correo;
        $men = $contact->mensaje;
        return $this->from('abcmedia.webmaster@gmail.com')->subject('Contactanos')->view('mailers.contact')->with('nombre', $nom)->with('correo', $cor)->with('mensaje', $men);
    }
}
