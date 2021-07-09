<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Order;
use App\Facture;
use App\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\PaymentIntent;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;




class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Cart::count()<=0){
            return redirect()->route('products.index');
                            }
           Stripe::setApiKey('sk_test_51HL9cDFuorsFn2kj3lc3qz4W7TrrXcsrmPH0aXKjTBpW7LFH16OjvHXKks3mRyuPSSi9CHn21jfFNQe0saZQ6K9a00CSrddrNw');

           if( request()->session()->has('coupon')){
           $total = Cart::total() - request()->session()->get('coupon')['remise']
           +(Cart::total() - request()->session()->get('coupon')['remise'] * (config('cart.tax') /100));
           }
           else {
               $total = Cart::total();
           }

           $intent = PaymentIntent::create([
            'amount' => round($total),
            'currency' => 'usd',
          ]);
          //dd($intent);
          $clientSecret = Arr::get($intent,'client_secret');

        return view('checkout.index',['clientSecret'=>$clientSecret,'total'=>$total]);
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
        //
       if($this->checkIfNotAvailable()){
        Session::flash('error','Un produit dans votre panier n\'est pas disponible.');
        return response()->json(['succes'=>false],400);
       }

        $data = $request->json()->all();

      $order = new Order();

        $order->payment_intent_id = $data['paymentIntent']['id'];

        $order->amount = $data['paymentIntent']['amount'];

        $order->payment_created_at = (new DateTime())->setTimestamp($data['paymentIntent']['created'])->format('Y-m-d H:i:s');

        $products = [];
        $i = 0;
        foreach(Cart::content() as $product){
            $products['product_'.$i][]=$product->model->image;
            $products['product_'.$i][]=$product->model->title;
            $products['product_'.$i][]=$product->model->price;
            $products['product_'.$i][]=$product->qty;
            $i++;
        }

        $order->products = serialize($products);

        $order->user_id = Auth()->user()->id;

        $order->save();




        if($data['paymentIntent']['status']==='succeeded'){
            $this->updateStock();
            Cart::destroy();
            Session::flash('success','Commande effectuée avec succès.');
            return response()->json(['success'=>'Payment Intent Succeeded ']);

        }
        else{
            return response()->json(['error'=>'Payment Intent Not Succeeded ']);
        }

        //return redirect()->route('products.index');
       // return $data['paymentIntent'];
    }

    public function thankYou(){

        $commande = DB::table('orders')->latest('id')->first();
        $product = $commande->products;
        $products = unserialize($product);
        $date = $commande->payment_created_at;
        $montant =  $commande->amount;
        $name = Auth()->user()->name;
        $mail = Auth()->user()->email;
        $fact = $commande->id;


 /*if(Session::has('success')){
$pdf = PDF::loadview('checkout.thankyou',['products'=>$products]);

 return $pdf->download("pdf");
 return view('checkout.thankyou',['products'=>$products]);
}
else {
    redirect()->route('products.index');
}
*/
        return Session::has('success') ? view('checkout.thankyou',['products'=>$products,'date'=>$date,'montant'=>$montant,'name'=>$name,'mail'=>$mail,'fact'=>$fact]) : redirect()->route('products.index');
       //return  PDF::loadView('checkout.thankyou');
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

    private function checkIfNotAvailable(){
        foreach(Cart::content() as $item){
            $product = Product::find($item->model->id);

            if($product->stock < $item->qty){
                return true;
            }
          }
          return false;
    }

    private function updateStock(){
        foreach(Cart::content() as $item){
          $product = Product::find($item->model->id);
           $product->update(['stock'=>$product->stock - $item->qty]);
        }
    }

    public function getPostPdf(){
        $commande = DB::table('orders')->latest('id')->first();
       $product = $commande->products;
       $date = $commande->payment_created_at;
       $montant =  $commande->amount;
       $name = Auth()->user()->name;
       $mail = Auth()->user()->email;
       $products = unserialize($product);
       $fact = $commande->id;


       $pdf = PDF::loadview('checkout.download',['products'=>$products,'date'=>$date,'montant'=>$montant,'name'=>$name,'mail'=>$mail,'fact'=>$fact]);

       return $pdf->download("facture.pdf");
   }
   public function livreur(){

    $livreur = DB::table('livraisons')->get();

   return view('checkout.livraison', ['livreur' => $livreur]);
}
}
