<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayMail;
use App\Mail\FactMail;
use Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payee;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Auth;
use App\Product;
use App\User;
use App\Paypal;
use App\PayPI;
use Socialgest\Instapago\Instapago;

class PaymentController extends Controller
{
	private $apicontext;
    private $instaId = '0699BCF1-DFF7-44CE-9538-8E207AEB1039';
    private $instaPublic = 'fda99dc6a965f221bd68aadf71de4789';
    private $ip = '127.0.0.1';

    public function __construct(){
    	$paypalconf = \Config::get('paypal');
    	$this->apicontext = new ApiContext(new OAuthTokenCredential(
    		$paypalconf['client_id'], 
    		$paypalconf['secret'],
    	));
    	$this->apicontext->setConfig($paypalconf['settings']);
    }

    public function paywithPaypal(Request $request){
        try{
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item1 = new Item();

            $precio = $request->prodprecio;

            $item1->setName($request->prodnombre)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($precio);

            $itemlist = new ItemList();
            $itemlist->setItems(array($item1));

            $payee = new Payee();
            $payee->setEmail($request->userpaypal);

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($precio);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemlist)
                ->setDescription('ABCMedia');

            $payPI = new PayPI;
            $user = Auth::user();
            $prodid = $request->prodid;
            $metodo = 'Paypal';
            $estado = 'Procesando';
            $fechaactual = new \DateTime();
            $payPI->metodo = $metodo;
            $payPI->estado = $estado;
            $payPI->fecha = $fechaactual->format('d-m-Y H:i:s');
            $payPI->monto = $precio;
            $payPI->id_user = $user->id;
            $payPI->id_product = $prodid;
            $payPI->save();

            $redirecturls = new RedirectUrls();
            $redirecturls->setReturnUrl(URL::to('status'))
                ->setCancelUrl(URL::to('status'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirecturls)
                ->setTransactions(array($transaction));
        }catch(Exception $ex){
            return view('error');
        }
    	
    	try{
    		$payment->create($this->apicontext);
    	} catch(\Paypal\Exception\PPConnectionException $ex){
    		if(\Config::get('app.debug')){
    		//	\Session::put('error', 'Connection timeout');
    			return Redirect::to('timeout');
    		} else{
    		//	\Session::put('error', 'Some error occur, sorry for inconvenient');
    			return Redirect::to('error');
    		}
    	}

    	foreach($payment->getLinks() as $link){
    		if($link->getRel() == 'approval_url'){
    			$redirecturls = $link->getHref();
    			break;
    		}
    	}

    	Session::put('paypal_payment_id', $payment->getId());

    	if(isset($redirecturls)){
    		return Redirect::away($redirecturls);
    	}

    	// \Session::put('error', 'Unknown error occurred');
    	return Redirect::to('error');
    }

    public function getPaymentStatus(Request $request){
    	$payment_id = Session::get('paypal_payment_id');

    	Session::forget('paypal_payment_id');

    	if(empty(Input::get('PayerID')) || empty(Input::get('token'))){
    	//	\Session::put('error', 'Payment failed');

            $ultimo = PayPI::All()->last();
            $estado = 'Fallido';
            \DB::table('pay_p_is')->where('id', $ultimo->id)->update(['estado'=>$estado]);

    		return Redirect::to('failed');
    	}

    	$payment = Payment::get($payment_id, $this->apicontext);
    	$execution = new PaymentExecution();
    	$execution->setPayerId(Input::get('PayerID'));

    	$result = $payment->execute($execution, $this->apicontext);

    	if($result->getState() == 'approved'){
    	//	\Session::put('success', 'Payment success');

            $ultimo = PayPI::All()->last();
            $estado = 'Exitoso';
            \DB::table('pay_p_is')->where('id', $ultimo->id)->update(['estado'=>$estado]);

            $paylast = PayPI::All()->last();
            $idproduct = $paylast->id_product;
            $producto = Product::find($idproduct);
            $cantidadnew = $producto->cantidad - 1;
            if($cantidadnew < 0){
                $cantidadnew = 0;
            }
            \DB::table('products')->where('id', $idproduct)->update(['cantidad'=>$cantidadnew]);
            $dueño = User::find($producto->id_user);
            $correodueño = $dueño->email;
            $comprador = User::find($paylast->id_user);
            $correocomprador = $comprador->email;
            Mail::to($correodueño)->send(new PayMail());
            Mail::to($correocomprador)->send(new FactMail());

    		return Redirect::to('successful');
    	}

    	// \Session::put('error', 'Payment failed');

        $ultimo = PayPI::All()->last();
        $estado = 'Fallido';
        \DB::table('pay_p_is')->where('id', $ultimo->id)->update(['estado'=>$estado]);

    	return Redirect::to('failed');
    }

    public function paywithInsta(Request $request)
	{
        try{
            $año = substr($request->fecha, 0, 4);
            $mes = substr($request->fecha, 5, 7);
            $fecha = $mes . '/' . $año;
            $paymentData = [
                'keyId' => $this->instaId,
                'publicKeyId' => $this->instaPublic,
                'amount' => $request->prodprecio,
                'description' => $request->prodnombre,
                'cardHolder' => $request->titular,
                'cardHolderId' => $request->cedula,
                'cardNumber' => $request->tarjeta,
                'cvc' => $request->cvc,
                'expirationDate' => $fecha,
                'IP' => $this->ip,
            ];
        }catch(Exception $ex){
            return view('error');
        }
        

	    try{
	            $instapago = new Instapago();
	            $respuesta = $instapago->directPayment($paymentData);

                $payPI = new PayPI;
                $user = Auth::user();
                $prodid = $request->prodid;
                $precio = $request->prodprecio;
                $metodo = 'InstaPago';
                $estado = 'Exitoso';
                $fechaactual = new \DateTime();
                $payPI->metodo = $metodo;
                $payPI->estado = $estado;
                $payPI->fecha = $fechaactual->format('d-m-Y H:i:s');
                $payPI->monto = $precio;
                $payPI->id_user = $user->id;
                $payPI->id_product = $prodid;
                $payPI->save();

                $paylast = PayPI::All()->last();
                $idproduct = $paylast->id_product;
                $producto = Product::find($idproduct);
                $cantidadnew = $producto->cantidad - 1;
                if($cantidadnew < 0){
                    $cantidadnew = 0;
                }
                \DB::table('products')->where('id', $idproduct)->update(['cantidad'=>$cantidadnew]);
                $dueño = User::find($producto->id_user);
                $correodueño = $dueño->email;
                $comprador = User::find($paylast->id_user);
                $correocomprador = $comprador->email;
                Mail::to($correodueño)->send(new PayMail());
                Mail::to($correocomprador)->send(new FactMail());

	            return view('successful');
	            // hacer algo con la respuesta
	    } catch(\Socialgest\Instapago\Instapago\Exceptions\InstapagoException $e){

            $payPI = new PayPI;
            $user = Auth::user();
            $prodid = $request->prodid;
            $precio = $request->prodprecio;
            $metodo = 'InstaPago';
            $estado = 'Fallido';
            $fechaactual = new \DateTime();
            $payPI->metodo = $metodo;
            $payPI->estado = $estado;
            $payPI->fecha = $fechaactual->format('d-m-Y H:i:s');
            $payPI->monto = $precio;
            $payPI->id_user = $user->id;
            $payPI->id_product = $prodid;
            $payPI->save();

	    	return view('failed');
	        // manejar el error
	    } catch(\Socialgest\Instapago\Instapago\Exceptions\TimeoutException $e){
	    	return view('timeout');
	        // manejar el error
	    } catch(Exception $ex){
            return view('error');
        } 
	}
}
