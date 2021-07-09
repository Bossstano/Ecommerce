<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
     if(request()->categorie){
       $products = Product::with('categories')->whereHas('categories',function($query){
           $query->where('slug',request()->categorie);
      })->paginate(6);
     }
     else
     if(request()->brand){
        $products = Product::with('brands')->whereHas('brands',function($query){
            $query->where('slug',request()->brand);
       })->paginate(6);
      }
     else{
        $products = Product :: inRandomOrder()->take(6)->get();
     }
        return view('products.index')->with('products',$products);
    }

    public function show($slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();
        $stock = $product->stock === 0? 'Indisponible' : 'Disponible';

        return view('products.show',['product'=>$product,'stock'=>$stock]);



    }

    public function search()
    {
       

        $q = request()->input('q');
       $products = Product::where('title','like',"%$q%")
       ->orWhere('description','like',"%$q%")
      ->paginate(6);

       return view('products.search')->with('products',$products);

    }
}
