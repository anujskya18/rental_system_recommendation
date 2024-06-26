<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\Cart;
use App\Models\Product\Order;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use Session;

class ProductsController extends Controller
{
    public  function singleCategory($id){
        $products = Product::select()->orderBy('id','desc')->where('category_id',$id)->get();
        return view('products.singlecategory',compact('products'));
    }
    public  function singleProduct($id){
        $product = Product::find($id);
        // $relatedProducts = Product::where('category_id',$product->category_id)->where('id','!=',$id)->get();
        if(isset(Auth::user()->id)){
                $checkInCart = Cart::where('pro_id',$id)->where('user_id',Auth::user()->id)->count();
            return view('products.singleproduct',compact('product','checkInCart'));
        }else
        return view('products.singleproduct',compact('product'));

    }
    public  function shop(){
        $categories= Category::select()->orderBy('id','desc')->get();  
              
        $Electronics= Product::select()->where('category_id','=',1)->orderBy('id','desc')->get();
        $Kitchen= Product::select()->where('category_id','=',2)->orderBy('id','desc')->get();
        $Trekking= Product::select()->where('category_id','=',3)->orderBy('id','desc')->get();
        return view('products.shop ',compact('categories','Electronics','Kitchen','Trekking'));
    }
    public function addcart(Request $request){
        $addCart = Cart::create([

            "name" => $request->name,
            "price" => $request->price,
            "qty" => $request->qty,
            "image" => $request->image,
            "pro_id" => $request->pro_id,
            "user_id" => Auth::user()->id,
            "subtotal" => $request->qty *$request->price,
       ] );

        if($addCart){
        return Redirect::route("single.product",$request->pro_id)->with(['success'=>"product added to cart successfully"]);
    }
    }
    public function updatecart(Request $request){

        $cartItem = Cart::find($request->id,); 
        $newQty = $request->qty;
        $cartItem;
        if ($cartItem) {
            $cartItem->qty = $newQty;
            $cartItem->subtotal = $newQty * $cartItem->price; // Update subtotal based on new quantity
        
            $cartItem->save(); // Save changes to the database
        }
    $cartProducts = Cart::select()->where('user_id',Auth::user()->id)->get();
    $subtotal = cart::where('user_id',Auth::user()->id)->sum('subtotal');

    return view('products.cart',compact('cartProducts','subtotal'));
    }
    public function cart(){
    $cartProducts = Cart::select()->where('user_id',Auth::user()->id)->get();
    $subtotal = cart::where('user_id',Auth::user()->id)->sum('subtotal');
    return view('products.cart',compact('cartProducts','subtotal'));
    }

public function deleteFromCart($id){
    $deleteCart = Cart::find($id);
    $deleteCart->delete();
    
    if($deleteCart){
        return Redirect::route("products.cart")->with(['delete'=>"product Deleted from cart successfully"]);
    }
    

}

public function PrepareCheckout(Request $request){
   $price =$request->price;
   $value = Session::put('value',$price);
    $newPrice= Session::get($value);
    if($newPrice > 0){
        return Redirect::route("products.checkout");
    }
}

public function checkout(){

    $cartItems = Cart::select()->where('user_id',Auth::user()->id)->get();
    if (count($cartItems) > 0){
        $cartArray = [];
        foreach($cartItems as $item){
            $data =  $item->name . '*'. $item->qty;
            array_push($cartArray, $data);
        }
        setrawcookie("cartArray", rawurlencode(implode(", ", $cartArray)), time() + 3600);
    }
    $checkoutSubtotal = Cart::select()->where('user_id',Auth::user()->id)->sum('subtotal');
    return view("products.checkout",compact('cartItems','checkoutSubtotal',));

}

public function processCheckout(Request $request){
  
    $checkout = Order::create([

        "name" => $request->name,
        // "last_name" => $request->last_name,
        "address" => $request->address,
        "email" => $request->email,
        "phone_number" => $request->phone_number,
        "user_id" => $request->user_id,
        "price" => $request->price,
        "order_notes" => isset($_COOKIE['cartArray']) ? urldecode($_COOKIE['cartArray']) : 'a',
        // "code"=> "$code",
   ] );

    if($checkout){
    // return view("/testroute");
        return Redirect::route("products.pay");
        // return view("products.pay");
}
}

public function verifyotp(Request $request) {
    // $code = random_int(100000, 999999); // Generates a random integer
    //return Redirect::route("/testroute");

    return view("products.otp");
    $otp = $request->otp;
    echo $code;
    if ($otp){
        return Redirect::route("products.pay");
    }

}

public function pay(){

    echo "sucessful";
    setcookie("ordervalidated", "", time() - 3600);
    setcookie("otpcode", "", time() - 3600);
    setcookie("cartArray", "", time() - 3600);
    $deleteItemsFromCart = Cart::where('user_id',Auth::user()->id);
    $deleteItemsFromCart->delete();
    Session::forget('value');
}

}