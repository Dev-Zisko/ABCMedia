<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function send_mail(Request $request)
    {
        try{
            $contact = new Contact;
            $contact->nombre = $request->nombre;
            $contact->correo = $request->email;
            $contact->mensaje = $request->mensaje;
            $contact->save();
            Mail::to("abcmedia.webmaster@gmail.com")->send(new ContactMail());
            return view('mailers.correct');
        }catch(Exception $ex){
            return view('error');
        }
        
    }
}
