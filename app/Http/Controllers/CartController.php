<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use App\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('cart.index');
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
      /* $duplicata = Cart::search(function($cartItem,$rowId) use ($request)
       {return $cartItem->rowId === $request->product_id;});

       if($duplicata->isNotEmpty()){
        return redirect()->route('products.index')->with('success','Le produit a déjà été ajoutée.');
       }*/
       $product = Product::find($request->product_id);
        Cart::add($product->id, $product->title,$request->quantity ,  $product->price)->associate('App\Product' );
        return redirect()->route('products.index')->with('success','PRODUIT AJOUTE AVEC SUCCES AU PANIER.');

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
    public function update(Request $request, $rowId)
    {
        //
        $data = $request->json()->all();

        $validator = Validator::make($request->all(),[
            'qty' => 'required|numeric'
        ]);

        if($validator->fails()){
            Session::flash('error','VEUILLEZ LA VALEUR DE LA QUANTITE.');
            return response()->json(['error'=>'Quantity Has Not Updated']);
        }

        if($data['qty'] > $data['stock']){
            Session::flash('danger','CETTE QUANTITE N\'EST PAS DISPONIBLE.');
            return response()->json(['danger'=>'Product Quantity Not Available']);
        }

        Cart::update($rowId, $data['qty']);

        Session::flash('success','UNE QUANTITE A ETE MODIFIEE AVEC SUCCES.');

        return response()->json(['success'=> 'Cart Quantity Has been Updated']);
    }

    public function storeCoupon(Request $request){

    $code = $request->get('code');
    $coupon = Coupon::where('code',$code)->first();

    if(!$coupon){
        return redirect()->back();
    }

    $request->session()->put('coupon',
    [
        'code'=> $coupon->code,
        'remise'=> $coupon->discount(Cart::subtotal())
    ]);
    return redirect()->back()->with('success','LE COUPON EST APPLIQUE.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        //
        Cart::remove($rowId);
        return back()->with('success','UN PRODUIT A ETE SUPPRIME. ');
    }

    public function destroyCoupon()
    {
        //
       request()->session()->forget('coupon');
       return redirect()->back()->with('success','LE COUPON A ETE RETIRE.');
    }
}
