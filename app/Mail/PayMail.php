<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;

use App\PayPI;
use App\Product;
use App\User;

class PayMail extends Mailable
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
        $payment = PayPI::All()->last();
        $metodo = $payment->metodo;
        $estado = $payment->estado;
        $fecha = $payment->fecha;
        $monto = $payment->monto;
        $iduser = $payment->id_user;
        $user = User::find($iduser);
        $nombre = $user->nombre . " " . $user->apellido;
        $cedula = $user->cedula;
        $telefono = $user->telefono;
        $correo = $user->email;
        $idproduct = $payment->id_product;
        $product = Product::find($idproduct);
        $producto = $product->nombre;
        return $this->from('abcmedia.webmaster@gmail.com')->subject('Pago')->view('mailers.payment')->with('metodo', $metodo)->with('estado', $estado)->with('fecha', $fecha)->with('monto', $monto)->with('nombre', $nombre)->with('cedula', $cedula)->with('telefono', $telefono)->with('correo', $correo)->with('producto', $producto);
    }
}
