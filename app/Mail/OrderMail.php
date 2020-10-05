<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;

use App\Order;
use App\Product;
use App\User;

class OrderMail extends Mailable
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
        $order = Order::All()->last();
        $mensaje = $order->mensaje;
        $cantidad = $order->cantidad;
        $fecha = $order->fecha;
        $iduser = $order->id_user;
        $user = User::find($iduser);
        $nombre = $user->nombre . " " . $user->apellido;
        $cedula = $user->cedula;
        $telefono = $user->telefono;
        $correo = $user->email;
        $idproduct = $order->id_product;
        $product = Product::find($idproduct);
        $producto = $product->nombre;
        return $this->from('abcmedia.webmaster@gmail.com')->subject('Pedido')->view('mailers.order')->with('mensaje', $mensaje)->with('cantidad', $cantidad)->with('fecha', $fecha)->with('nombre', $nombre)->with('cedula', $cedula)->with('telefono', $telefono)->with('correo', $correo)->with('producto', $producto);
    }
}
