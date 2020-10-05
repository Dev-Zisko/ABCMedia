<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Exception;
use Auth;
use App\Product;
use App\Comment;
use App\User;
use App\Category;
use App\Order;
use App\Paypal;
use App\PayPI;

class GeneralController extends Controller
{
    public function view_index(Request $request)
    {
        try{
            $consulta = \DB::table('products')->paginate(40);
            $categories = Category::All();
            return view('index', compact('consulta', 'categories'));
        }catch(Exception $ex){
            return view('error');
        }
		
    }

    public function view_mision(Request $request)
    {
        try{
            $categories = Category::All();
            return view('mision', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_nosotros(Request $request)
    {
        try{
            $categories = Category::All();
            return view('nosotros', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_privacidad(Request $request)
    {
        try{
            $categories = Category::All();
            return view('privacidad', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_terminos(Request $request)
    {
        try{
            $categories = Category::All();
            return view('terminos', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_timeout(Request $request)
    {
        try{
            return view('timeout');
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_error(Request $request)
    {
        try{
            return view('error');
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_successful(Request $request)
    {
        try{
            return view('successful');
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_failed(Request $request)
    {
        try{
            return view('failed');
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function search_index(Request $request)
    {
        try{
            if($request->categoria == "Categorías" && $request->texto == ""){
            $consulta = \DB::table('products')->paginate(40);
            $categories = Category::All();
            return view('index', compact('consulta', 'categories'));
            }
            if($request->categoria != "Categorías" && $request->texto == ""){
                $consulta = \DB::table('products')->where('categoria', $request->categoria)->paginate(40);
                $categories = Category::All();
                return view('index', compact('consulta', 'categories'));
            }
            if($request->categoria == "Categorías" && $request->texto != ""){
                $consulta = \DB::table('products')->where('nombre', 'LIKE', $request->texto . '%')->paginate(40);
                $categories = Category::All();
                return view('index', compact('consulta', 'categories'));
            }
            if($request->categoria != "Categorías" && $request->texto != ""){
                $consulta = \DB::table('products')->where('nombre', 'LIKE', $request->texto . '%')->orWhere('categoria', $request->categoria)->paginate(40);
                $categories = Category::All();
                return view('index', compact('consulta', 'categories'));
            }
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function search_admin(Request $request)
    {
        try{
            if($request->texto == ""){
                $users = \DB::table('users')->paginate(10);
                return view('dashboard.admin', compact('users'));
            }
            else{
                $users = \DB::table('users')->where('nombre', 'LIKE', $request->texto . '%')->orWhere('apellido', 'LIKE', $request->texto . '%')->orWhere('cedula', 'LIKE', $request->texto . '%')->orWhere('email', 'LIKE', $request->texto . '%')->orWhere('telefono', 'LIKE', $request->texto . '%')->orWhere('rol', 'LIKE', $request->texto . '%')->paginate(10);
                return view('dashboard.admin', compact('users'));
            }
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function search_category(Request $request)
    {
        try{
            if($request->texto == ""){
                $categories = \DB::table('categories')->paginate(10);
                return view('dashboard.category', compact('categories'));
            }
            else{
                $categories = \DB::table('categories')->where('nombre', 'LIKE', $request->texto . '%')->paginate(10);
                return view('dashboard.category', compact('categories'));
            }
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function search_product(Request $request)
    {
        try{
            if($request->texto == ""){
                $products = \DB::table('products')->paginate(10);
                $users = User::All();
                return view('dashboard.product', compact('products','users'));
            }
            else{
                $products = \DB::table('products')->where('nombre', 'LIKE', $request->texto . '%')->orWhere('categoria', 'LIKE', $request->texto . '%')->orWhere('precio', 'LIKE', $request->texto . '%')->orWhere('preciobs', 'LIKE', $request->texto . '%')->paginate(10);
                $users = User::All();
                return view('dashboard.product', compact('products','users'));
            }
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function search_payment(Request $request)
    {
        try{
            if($request->texto == ""){
                $payments = \DB::table('pay_p_is')->paginate(10);
                $users = User::All();
                $products = Product::All();
                return view('dashboard.payment', compact('payments','users','products'));
            }
            else{
                $payments = \DB::table('pay_p_is')->where('id', 'LIKE', $request->texto . '%')->orWhere('metodo', 'LIKE', $request->texto . '%')->orWhere('estado', 'LIKE', $request->texto . '%')->orWhere('fecha', 'LIKE', $request->texto . '%')->orWhere('monto', 'LIKE', $request->texto . '%')->paginate(10);
                $users = User::All();
                $products = Product::All();
                return view('dashboard.payment', compact('payments','users','products'));
            }
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function search_order(Request $request)
    {
        try{
            if($request->texto == ""){
                $orders = \DB::table('orders')->paginate(10);
                $users = User::All();
                $products = Product::All();
                return view('dashboard.order', compact('orders','users','products'));
            }
            else{
                $orders = \DB::table('orders')->where('cantidad', 'LIKE', $request->texto . '%')->orWhere('fecha', 'LIKE', $request->texto . '%')->paginate(10);
                $users = User::All();
                $products = Product::All();
                return view('dashboard.order', compact('orders','users','products'));
            }
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_venta(Request $request)
    {
        try{
            $categories = Category::All();
            return view('venta', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_pedido(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $producto = Product::find($newid);
            return view('pedido', compact('producto'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_publicaciones(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $consulta = \DB::table('products')->where('id_user', $newid)->paginate(40);
            return view('publicaciones', compact('consulta'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_pago(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $producto = Product::find($newid);
            $usuario = User::where('id', '=', $producto->id_user)->first();
            return view('pago', compact('producto', 'usuario'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_insta(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $producto = Product::find($newid);
            $usuario = User::where('id', '=', $producto->id_user)->first();
            return view('insta', compact('producto', 'usuario'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_rproduct(Request $request)
    {
        try{
            $categories = Category::All();
            return view('dashboard.rproduct', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_producto(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $producto = Product::find($newid);
            $comentario = \DB::table('comments')->where('id_product', '=', $newid)->orderBy('fecha', 'desc')->paginate(5);
            
            $usuario = User::where('id', '=', $producto->id_user)->first();
            return view('producto', compact('producto', 'comentario', 'usuario'));
        }catch(Exception $ex){
            return view('error');
        }
    	
    }

    public function view_uuser(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $user = User::find($newid);
            return view('dashboard.uuser', compact('user'));
        }catch(Exception $ex){
            return view('error');
        }

    }

    public function view_perfil(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $user = User::find($newid);
            return view('perfil', compact('user'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_duser(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $user = User::find($newid);
            return view('dashboard.duser', compact('user'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_admin(Request $request)
    {
        try{
            $users = \DB::table('users')->paginate(10);
            return view('dashboard.admin', compact('users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_order(Request $request)
    {
        try{
            $orders = \DB::table('orders')->paginate(10);
            $users = User::All();
            $products = Product::All();
            return view('dashboard.order', compact('orders','users','products'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_payment(Request $request)
    {
        try{
            $payments = \DB::table('pay_p_is')->paginate(10);
            $users = User::All();
            $products = Product::All();
            return view('dashboard.payment', compact('payments','users','products'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_category(Request $request)
    {
        try{
            $categories = \DB::table('categories')->paginate(10);
            return view('dashboard.category', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_ucategory(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $category = Category::find($newid);
            return view('dashboard.ucategory', compact('category'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_dcategory(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $category = Category::find($newid);
            return view('dashboard.dcategory', compact('category'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_dorder(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $order = Order::find($newid);
            return view('dashboard.dorder', compact('order'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_dpayment(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $payment = PayPI::find($newid);
            return view('dashboard.dpayment', compact('payment'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_product(Request $request)
    {
        try{
            $products = \DB::table('products')->paginate(10);
            $users = User::All();
            return view('dashboard.product', compact('products','users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_uproduct(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $product = Product::find($newid);
            $categories = Category::All();
            return view('dashboard.uproduct', compact('product','categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_publicacion(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $product = Product::find($newid);
            $categories = Category::All();
            return view('publicacion', compact('product','categories'));
        }catch(Exception $ex){
            return view('error');
        }

    }

    public function view_dproduct(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            $product = Product::find($newid);
            $categories = Category::All();
            return view('dashboard.dproduct', compact('product','categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function register_user(Request $request)
    {
        try{
            $user = new User;
            $user->nombre = $request->nombre;
            $user->apellido = $request->apellido;
            $user->cedula = $request->cedula;
            $user->email = $request->email;
            $user->telefono = $request->telefono;
            $user->paypal = $request->paypal;
            $user->rol = $request->rol;
            $encrypass = Hash::make($request->password);
            $user->password = $encrypass;
            $user->save();
            $users = \DB::table('users')->paginate(10);
            return view('dashboard.admin', compact('users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function register_category(Request $request)
    {
        try{
            $category = new Category;
            $category->nombre = $request->nombre;
            $category->save();
            $categories = \DB::table('categories')->paginate(10);
            return view('dashboard.category', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function register_product(Request $request)
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
            $products = \DB::table('products')->paginate(10);
            $users = User::All();
            return view('dashboard.product', compact('products','users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function update_user(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('users')->where('id', $newid)->update(['nombre'=>$request->nombre]);
            \DB::table('users')->where('id', $newid)->update(['apellido'=>$request->apellido]);
            \DB::table('users')->where('id', $newid)->update(['cedula'=>$request->cedula]);
            \DB::table('users')->where('id', $newid)->update(['email'=>$request->email]);
            \DB::table('users')->where('id', $newid)->update(['telefono'=>$request->telefono]);
            \DB::table('users')->where('id', $newid)->update(['paypal'=>$request->paypal]);
            \DB::table('users')->where('id', $newid)->update(['rol'=>$request->rol]);
            $encrypass = Hash::make($request->password);
            \DB::table('users')->where('id', $newid)->update(['password'=>$encrypass]);
            $users = \DB::table('users')->paginate(10);
            return view('dashboard.admin', compact('users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function update_perfil(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('users')->where('id', $newid)->update(['nombre'=>$request->nombre]);
            \DB::table('users')->where('id', $newid)->update(['apellido'=>$request->apellido]);
            \DB::table('users')->where('id', $newid)->update(['email'=>$request->email]);
            \DB::table('users')->where('id', $newid)->update(['telefono'=>$request->telefono]);
            \DB::table('users')->where('id', $newid)->update(['paypal'=>$request->paypal]);
            $encrypass = Hash::make($request->password);
            \DB::table('users')->where('id', $newid)->update(['password'=>$encrypass]);
            $consulta = \DB::table('products')->paginate(40);
            $categories = Category::All();
            return view('index', compact('consulta', 'categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function update_category(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('categories')->where('id', $newid)->update(['nombre'=>$request->nombre]);
            $categories = \DB::table('categories')->paginate(10);
            return view('dashboard.category', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function update_product(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('products')->where('id', $newid)->update(['nombre'=>$request->nombre]);
            \DB::table('products')->where('id', $newid)->update(['categoria'=>$request->categoria]);
            \DB::table('products')->where('id', $newid)->update(['descripcion'=>$request->descripcion]);
            \DB::table('products')->where('id', $newid)->update(['precio'=>$request->precio]);
            \DB::table('products')->where('id', $newid)->update(['preciobs'=>$request->preciobs]);
            \DB::table('products')->where('id', $newid)->update(['cantidad'=>$request->cantidad]);
            \DB::table('products')->where('id', $newid)->update(['peso'=>$request->peso]);
            \DB::table('products')->where('id', $newid)->update(['medidas'=>$request->medidas]);
            if ($request->hasFile('imagen1'))
            {
                $nuevaFoto1 = $request->file('imagen1')->store('public');
                $Foto1 = substr($nuevaFoto1, 7);
                \DB::table('products')->where('id', $newid)->update(['imagen1' => $Foto1]);
            }
            if ($request->hasFile('imagen2'))
            {
                $nuevaFoto2 = $request->file('imagen2')->store('public');
                $Foto2 = substr($nuevaFoto2, 7);
                \DB::table('products')->where('id', $newid)->update(['imagen2' => $Foto2]); 
            }
            if ($request->hasFile('imagen3'))
            {
                $nuevaFoto3 = $request->file('imagen3')->store('public');
                $Foto3 = substr($nuevaFoto3, 7);
                \DB::table('products')->where('id', $newid)->update(['imagen3' => $Foto3]);  
            }
            $products = \DB::table('products')->paginate(10);
            $users = User::All();
            return view('dashboard.product', compact('products','users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function update_publicacion(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('products')->where('id', $newid)->update(['nombre'=>$request->nombre]);
            \DB::table('products')->where('id', $newid)->update(['categoria'=>$request->categoria]);
            \DB::table('products')->where('id', $newid)->update(['descripcion'=>$request->descripcion]);
            \DB::table('products')->where('id', $newid)->update(['precio'=>$request->precio]);
            \DB::table('products')->where('id', $newid)->update(['preciobs'=>$request->preciobs]);
            \DB::table('products')->where('id', $newid)->update(['cantidad'=>$request->cantidad]);
            \DB::table('products')->where('id', $newid)->update(['peso'=>$request->peso]);
            \DB::table('products')->where('id', $newid)->update(['medidas'=>$request->medidas]);
            if ($request->hasFile('imagen1'))
            {
                $nuevaFoto1 = $request->file('imagen1')->store('public');
                $Foto1 = substr($nuevaFoto1, 7);
                \DB::table('products')->where('id', $newid)->update(['imagen1' => $Foto1]);
            }
            if ($request->hasFile('imagen2'))
            {
                $nuevaFoto2 = $request->file('imagen2')->store('public');
                $Foto2 = substr($nuevaFoto2, 7);
                \DB::table('products')->where('id', $newid)->update(['imagen2' => $Foto2]); 
            }
            if ($request->hasFile('imagen3'))
            {
                $nuevaFoto3 = $request->file('imagen3')->store('public');
                $Foto3 = substr($nuevaFoto3, 7);
                \DB::table('products')->where('id', $newid)->update(['imagen3' => $Foto3]);  
            }
            $idusernot = Product::find($newid);
            $iduser = $idusernot->id_user;
            $consulta = \DB::table('products')->where('id_user', $iduser)->paginate(40);
            return view('publicaciones', compact('consulta'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function delete_user(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('orders')->where('id_user', $newid)->delete();
            \DB::table('pay_p_is')->where('id_user', $newid)->delete();
            \DB::table('comments')->where('id_user', $newid)->delete();
            \DB::table('products')->where('id_user', $newid)->delete();
            \DB::table('users')->where('id', $newid)->delete();
            $users = \DB::table('users')->paginate(10);
            return view('dashboard.admin', compact('users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function delete_category(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('categories')->where('id', $newid)->delete();
            $categories = \DB::table('categories')->paginate(10);
            return view('dashboard.category', compact('categories'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function delete_order(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('orders')->where('id', $newid)->delete();
            $orders = \DB::table('orders')->paginate(10);
            $users = User::All();
            $products = Product::All();
            return view('dashboard.order', compact('orders','users','products'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function delete_payment(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('pay_p_is')->where('id', $newid)->delete();
            $payments = \DB::table('pay_p_is')->paginate(10);
            $users = User::All();
            $products = Product::All();
            return view('dashboard.payment', compact('payments','users','products'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function delete_product(Request $request, $id)
    {
        try{
            $newid = Crypt::decrypt($id);
            \DB::table('orders')->where('id_product', $newid)->delete();
            \DB::table('pay_p_is')->where('id_product', $newid)->delete();
            \DB::table('comments')->where('id_product', $newid)->delete();
            \DB::table('products')->where('id', $newid)->delete();
            $products = \DB::table('products')->paginate(10);
            $users = User::All();
            return view('dashboard.product', compact('products','users'));
        }catch(Exception $ex){
            return view('error');
        }
        
    }

    public function view_comment(Request $request, $id)
    {
        try{
            $eliminar = Comment::where('id', '=', $id)->get();
            \DB::table('comments')->where('id', $id)->delete();
            return view('comment');
        }catch(Exception $ex){
            return view('error');
        }
        
    }
}
