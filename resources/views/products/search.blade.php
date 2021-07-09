
@extends('layouts.master')

@section('content')
@foreach ($products as $product )

                        <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('storage/'.$product->image)}}" alt="" />
											<h2 class="mb-0">{{ $product->getprice() }}</h2>
                                            <p class="mb-0">{{ $product->title }}</p>
                                            <a href="{{route('products.show',$product->slug)}}" class="stretched-link btn btn-primary">Voir l'article</a>

										</div>

								</div>
							</div>
						</div>

                        @endforeach

@endsection
