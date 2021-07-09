<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(){

       /* $commande = DB::table('orders')->latest('id')->first();
        $product = $commande->products;
        $products = unserialize($product);

        $pdf = PDF::loadview('orders.index',['products'=>$products]);

        return $pdf->download("codingdriver.pdf");*/
       //$pdf =  PDF::loadview('orders.index');
       //return $pdf->download('codingdriver.pdf');
     return view('orders.index');
    }

    public function getPostPdf(){
         $commande = DB::table('orders')->latest('id')->first();
        $product = $commande->products;
        $date = $commande->payment_created_at;
        $montant =  $commande->amount;
        $id = Auth()->user()->id;
        $products = unserialize($product);


        $pdf = PDF::loadview('orders.download',['products'=>$products,'date'=>$date,'montant'=>$montant,'id'=>$id]);

        return $pdf->download("codingdriver.pdf");
    }
}
