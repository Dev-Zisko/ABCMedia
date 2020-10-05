<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Auth;
use App\Product;
use App\Category;

class ProductController extends Controller
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

            $product = new Product;
            $product->nombre = $request->nombre;
            $product->categoria = $request->categoria;
            $product->descripcion = $request->descripcion;
            $product->precio = $request->precio;
            $product->preciobs = $request->preciobs;
            $product->cantidad = $request->cantidad;
            $product->peso = $request->peso;
            $medida1 = $request->medida1;
            $medida2 = $request->medida2;
            $medida3 = $request->medida3;
            $product->medidas = $medida1 . "x" . $medida2 . "x" . $medida3;
            if ($request->hasFile('imagen1'))
            {
                $nuevaFoto1 = $request->file('imagen1')->store('public');
                $Foto1 = substr($nuevaFoto1, 7);
                $product->imagen1 = $Foto1;
            }
            if ($request->hasFile('imagen2'))
            {
                $nuevaFoto2 = $request->file('imagen2')->store('public');
                $Foto2 = substr($nuevaFoto2, 7); 
                $product->imagen2 = $Foto2;
            }
            if ($request->hasFile('imagen3'))
            {
                $nuevaFoto3 = $request->file('imagen3')->store('public');
                $Foto3 = substr($nuevaFoto3, 7); 
                $product->imagen3 = $Foto3;
            }
            $product->id_user = Auth::user()->id;
            $product->save();
            $consulta = \DB::table('products')->paginate(40);
            $categories = Category::All();
            return view('index', compact('consulta','categories'));

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
