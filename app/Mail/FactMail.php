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

class FactMail extends Mailable
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
        $id = $payment->id;
        $metodo = $payment->metodo;
        $estado = $payment->estado;
        $fecha = $payment->fecha;
        $monto = $payment->monto;
        $idproduct = $payment->id_product;
        $product = Product::find($idproduct);
        $producto = $product->nombre;
        return $this->from('abcmedia.webmaster@gmail.com')->subject('Pago')->view('mailers.factura')->with('id', $id)->with('metodo', $metodo)->with('estado', $estado)->with('fecha', $fecha)->with('monto', $monto)->with('producto', $producto);
    }
}
