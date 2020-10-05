<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Auth;

use App\Order;
use App\Product;
use App\User;

class OrderController extends Controller
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

    public function send_order(Request $request, $id)
    {
        try{
            $order = new Order;
            $user = Auth::user();
            $fecha = new \DateTime();
            $newid = Crypt::decrypt($id);
            $producto = Product::find($newid);
            $order->mensaje = $request->mensaje;
            $order->cantidad = $request->cantidad;
            $order->fecha = $fecha->format('d-m-Y H:i:s');
            $order->id_user = $user->id;
            $order->id_product = $newid;
            $order->save();
            $orderlast = Order::All()->last();
            $iduser_product = $producto->id_user;
            $dueño = User::find($iduser_product);
            $correodueño = $dueño->email;
            Mail::to($correodueño)->send(new OrderMail());
            return view('mailers.correcto', compact('dueño'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }
}
