
@extends('layouts.master')

@section('content')
                        <div class="col-sm-12">
							<div class="product-image-wrapper">

								<div class="single-products">
                                    <h1 class="mb-0">
                                        @foreach ($product->categories as $category )
                                        {{$category->name}}{{$loop->last ? '':','}}
                                        @endforeach
                                    </h1>
                                    <h1 class="mb-0">
                                        @foreach ($product->brands as $brand )
                                        {{$brand->name}}{{$loop->last ? '':','}}
                                        @endforeach
                                    </h1>

                                    <div class="badge badge-pill badge-info">{{$stock}}</div>
										<div class="">
                                            <img src="{{asset('storage/'.$product->image)}}" height="300" width="300" alt="" id="mainImage" />
                                            @if($product->images)

                                            <img src="{{asset('storage/'.$product->image)}}" height="100" width="100" alt="" class="img-thumbnail" />

                                            @foreach (json_decode($product->images,true)  as $image)
                                            <img src="{{asset('storage/'.$image)}}" height="100" width="100" alt=""  class="img-thumbnail" />
                                            @endforeach


                                            @endif

											<h2 class="mb-0">{{ $product->title }}</h2>
                                            <h3 class="mb-0">{{ $product->description }}</h3>
                                            <h3 class="mb-0"> QUANTITE DU PRODUIT EN STOCK : {{ $product->stock }}</h3>
                                            <h2 class="mb-0">{{ $product->getprice() }}</h2>
                                            @if($stock === 'Disponible')
                                                <form method="POST" action="{{ route('cart.store') }}" >
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                   <p> Choisir ou entrer la quantité à commander</p>
                                                    <input  name="quantity" type="number" value="" min="1"><br>
                                                    <button type="submit" class="btn btn-primary">
                                                        Ajouter au panier
                                                    </button>
                                                </form>
                                            @endif
										</div>
								</div>
							</div>
						</div>

                        <script>
                            var mainImage = document.querySelector('#mainImage');
                            var thumbnails = document.querySelectorAll('.img-thumbnail');

                            thumbnails.forEach((element) => element.addEventListener('click', changeImage));

                            function changeImage(e){
                                mainImage.src = this.src;
                            }
                         </script>


@endsection




