<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Auth;
use App\Product;
use App\Comment;
use App\User;

class CommentController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $ultimo = Comment::All()->last();
            if(is_null($ultimo))
            {
                $comment = new Comment;
                $comment->descripcion = $request->descripcion;
                $fecha = new \DateTime();
                $comment->fecha = $fecha->format('d-m-Y H:i:s');
                $comment->id_user = Auth::user()->id;
                $comment->nombre = Auth::user()->nombre . " " . Auth::user()->apellido;
                $comment->id_product = $request->idproduct;
                $comment->save();
                $producto = Product::find($request->idproduct);
                $comentario = \DB::table('comments')->where('id_product', '=', $request->idproduct)->orderBy('fecha', 'desc')->paginate(5);
                $usuario = User::where('id', '=', $producto->id_user)->first();
                return view('producto', compact('producto', 'comentario', 'usuario'));
            }
            else if(($ultimo->nombre == Auth::user()->nombre . " " . Auth::user()->apellido) && ($ultimo->descripcion == $request->descripcion))
            {
                $producto = Product::find($request->idproduct);
                $comentario = \DB::table('comments')->where('id_product', '=', $request->idproduct)->orderBy('fecha', 'desc')->paginate(5);
                $usuario = User::where('id', '=', $producto->id_user)->first();
                return view('producto', compact('producto', 'comentario', 'usuario'));
            }
            else
            {
                $comment = new Comment;
                $comment->descripcion = $request->descripcion;
                $fecha = new \DateTime();
                $comment->fecha = $fecha->format('d-m-Y H:i:s');
                $comment->id_user = Auth::user()->id;
                $comment->nombre = Auth::user()->nombre . " " . Auth::user()->apellido;
                $comment->id_product = $request->idproduct;
                $comment->save();
                $producto = Product::find($request->idproduct);
                $usuario = User::where('id', '=', $producto->id_user)->first();
                $comentario = \DB::table('comments')->where('id_product', '=', $request->idproduct)->orderBy('fecha', 'desc')->paginate(5);
                return view('producto', compact('producto', 'comentario', 'usuario'));
            }
        }catch(Exception $ex){
            return view('error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
