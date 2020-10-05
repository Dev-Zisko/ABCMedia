<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'auth'], function(){

	Route::get('admin', 'GeneralController@view_admin');

    Route::post('admin', 'GeneralController@search_admin');

    Route::get('ruser', function () { return view('dashboard.ruser'); });

    Route::post('ruser', 'GeneralController@register_user');

    Route::get('uuser/{id}', 'GeneralController@view_uuser');

    Route::post('uuser/{id}', 'GeneralController@update_user');

    Route::get('duser/{id}', 'GeneralController@view_duser');

    Route::post('duser/{id}', 'GeneralController@delete_user');

    Route::get('category', 'GeneralController@view_category');

    Route::post('category', 'GeneralController@search_category');

    Route::get('rcategory', function () { return view('dashboard.rcategory'); });

    Route::post('rcategory', 'GeneralController@register_category');

    Route::get('ucategory/{id}', 'GeneralController@view_ucategory');

    Route::post('ucategory/{id}', 'GeneralController@update_category');

    Route::get('dcategory/{id}', 'GeneralController@view_dcategory');

    Route::post('dcategory/{id}', 'GeneralController@delete_category');

    Route::get('product', 'GeneralController@view_product');

    Route::post('product', 'GeneralController@search_product');

    Route::get('rproduct', 'GeneralController@view_rproduct');

    Route::post('rproduct', 'GeneralController@register_product');

    Route::get('uproduct/{id}', 'GeneralController@view_uproduct');

    Route::post('uproduct/{id}', 'GeneralController@update_product');

    Route::get('dproduct/{id}', 'GeneralController@view_dproduct');

    Route::post('dproduct/{id}', 'GeneralController@delete_product');

    Route::get('order', 'GeneralController@view_order');

    Route::post('order', 'GeneralController@search_order');

    Route::get('dorder/{id}', 'GeneralController@view_dorder');

    Route::post('dorder/{id}', 'GeneralController@delete_order');

    Route::get('payment', 'GeneralController@view_payment');

    Route::post('payment', 'GeneralController@search_payment');

    Route::get('dpayment/{id}', 'GeneralController@view_dpayment');

    Route::post('dpayment/{id}', 'GeneralController@delete_payment');

    Route::get('venta', 'GeneralController@view_venta');

    Route::post('venta', 'ProductController@store');

    Route::get('producto/{id}', 'GeneralController@view_producto');

	Route::post('producto/{id}', 'CommentController@store');

    Route::get('comment/{id}', 'GeneralController@view_comment');

    Route::get('pedido/{id}', 'GeneralController@view_pedido');

    Route::post('pedido/{id}', 'OrderController@send_order');

    Route::get('pago/{id}', 'GeneralController@view_pago');

    Route::post('pago/{id}', 'PaymentController@paywithPaypal');

    Route::get('insta/{id}', 'GeneralController@view_insta');

    Route::post('insta/{id}', 'PaymentController@paywithInsta');

    Route::get('status', 'PaymentController@getPaymentStatus');

    Route::get('perfil/{id}', 'GeneralController@view_perfil');

    Route::post('perfil/{id}', 'GeneralController@update_perfil');

    Route::get('publicaciones/{id}', 'GeneralController@view_publicaciones');

    Route::get('publicacion/{id}', 'GeneralController@view_publicacion');

    Route::post('publicacion/{id}', 'GeneralController@update_publicacion');

});

Route::get('/', 'GeneralController@view_index');

Route::post('/', 'GeneralController@search_index');

Route::get('index', 'GeneralController@view_index');

Route::post('index', 'GeneralController@search_index');

Route::get('mision', 'GeneralController@view_mision');

Route::post('mision', 'GeneralController@search_index');

Route::get('nosotros', 'GeneralController@view_nosotros');

Route::post('nosotros', 'GeneralController@search_index');

Route::get('privacidad', 'GeneralController@view_privacidad');

Route::post('privacidad', 'GeneralController@search_index');

Route::get('terminos', 'GeneralController@view_terminos');

Route::post('terminos', 'GeneralController@search_index');

Route::post('contactanos', 'ContactController@send_mail');

Route::get('register', function () {
    return view('auth.register');
});

Route::get('login', function () {
    return view('auth.login');
});

Route::get('contactanos', function () {
    return view('contactanos');
});

Route::get('404', function(){
    abort(404);
});

Route::get('timeout', 'GeneralController@view_timeout');

Route::get('error', 'GeneralController@view_error');

Route::get('successful', 'GeneralController@view_successful');

Route::get('failed', 'GeneralController@view_failed');

Auth::routes();