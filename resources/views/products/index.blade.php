
@extends('layouts.master')


@section('contenu')
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>CATEGORIES</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach (App\Category::all() as  $category )
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{route('products.index',['categorie'=>
                    $category->slug])}}">{{$category->name}} </a></h4>
                </div>
            </div>
            @endforeach

        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>MARQUES</h2>
            <div class="panel-group category-products" id="accordian">
                @foreach (App\Brand::all() as  $brand )
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{route('products.index',['brand'=>
                        $brand->slug])}}">{{$brand->name}} </a></h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div><!--/brands_products-->

    </div>
</div>

@endsection

@section('content')

<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">NOS ARTICLES</h2>
        @foreach ($products as $product )
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset('storage/'.$product->image)}}"  alt="" />
                            <h2 class="mb-0">{{ $product->getprice() }}</h2>
                            <p class="mb-0">{{ $product->title }}</p>
                            <a href="{{route('products.show',$product->slug)}}" class="btn btn-default add-to-cart">Voir l'article</a>

                        </div>
                </div>
            </div>
        </div>
        @endforeach
    </div><!--features_items-->
</div>

@endsection

@section('rechercher')


<div class="col-sm-3">
    @include('partials.search')
</div>

@endsection
