<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\Order;
use Session;
use App\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getIndex(){
    	$products = Product::all();
    	return view('shop.index', ['products'=>$products]);
    }

    public function addToCart(Request $request, $id){
    	$product = Product::find($id);
    	$oldCart = Session::has('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
		//dd($request->session()->get('cart'));
        return redirect()->route('home');

  }

  public function getCart(){

    if(!Session::has('cart')){
        return view('shop.shopping-cart', ['products' => null]);
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return view('shop.shopping-cart', ['products'=> $cart->items, 'totalPrice'=>$cart->totalPrice]);
}

public function getCheckout(){

    if(!Session::has('cart')){
        return view('shop.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrice;
    return view('shop.checkout', ['total'=>$total]);
}

public function postCheckout(Request $request){

    if(!Session::has('cart')){
        return redirect()->route('shop.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);


    Stripe::setApiKey("sk_test_ZVLQwXBmPyckEWlJ2rBSSHCm");

try{
    $charge = Charge::create(array(
      "amount" => $cart->totalPrice * 100,
      "currency" => "usd",
      "source" => $request->input('stripeToken'),
      "description" => "Charge for Test"
  ));

$order = new Order();
$order->cart = serialize($cart);
$order->address = $request->input('address');
$order->name = $request->input('cardholder-name');
$order->purchase_id = $charge->id;

Auth::user()->orders()->save($order);

    }catch(\Exception $e){
        return redirect()->route('checkout')->with('error', $e->getMessage());
    }

    Session::forget('cart');
    return redirect()->route('home')->with('success', 'Successfully Purchased');
}

public function reduceByone(Request $request, $id){
    $product = Product::find($id);
    $oldCart = Session::has('cart')?Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->reduceByone($product, $product->id);
    $request->session()->put('cart', $cart);
    //dd($request->session()->get('cart'));
    return redirect()->route('shoppingCart');
}

public function reduceAll(){
            Session::forget('cart');
            return redirect()->route('home');
        }


}
