<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i></a></li>
								<li><a href=""><i class="fa fa-envelope"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div><!--/header_top-->
        @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
     @endif
        @if (session('danger'))
        <div class="alert alert-danger">
            {{session('danger')}}
        </div>
    @endif


		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">

						</div>

					</div>
                    <div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{route('cart.index')}}"><i class="fa fa-shopping-cart">Panier({{Cart::count()}})</i></a></li>
								@include('partials.auth')
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ route('products.index') }}" class="active">Acceuil</a></li>


							</ul>
						</div>
					</div>
					<div class="col-sm-3">

					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="cart_items">
		<div class="container">

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">IMAGE</td>
							<td class="description">ARTICLE</td>
							<td class="price">PRIX UNITAIRE</td>
							<td class="quantity">QUANTITE</td>
							<td class="total">MONTANT TOTAL</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

                        @if (Cart::count()>0)
                        @foreach (Cart::content() as $product )
                        <tr>
							<td class="cart_product">
								<a href=""><img src="{{asset('storage/'.$product->model->image)}}" height="100" width="100" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$product->model->title}}</a></h4>
								<p></p>
							</td>
							<td class="cart_price">
								<p>{{$product->model->getprice()}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
                                    <?php  $i = $product->qty ?>
                                    <input class="cart_quantity_input" id="qty"  data-id="{{ $product->rowId }}" data-stock="{{ $product->model->stock }}" type="number" min="1" name="quantity" value="{{$i}}" autocomplete="off" size="2">

                                </div>
                                <script>
                                 var selects =   document.querySelectorAll('#qty');
                                 Array.from(selects).forEach((element)=>{
                                element.addEventListener('change',function(){
                                    var rowId = this.getAttribute('data-id');
                                    var stock = this.getAttribute('data-stock');
                                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                    fetch(
                                        `/panier/${rowId}`,
                                        {
                                            headers:{
                                                "Content-Type":"application/json",
                        "Accept":"application/json ,text-plain, */*",
                        "X-Requested-With":"XMLHttpRequest",
                        "X-CSRF-TOKEN": token,

                                            },
                    method:'put',
                    body: JSON.stringify({qty : this.value,
                                          stock : stock
                    })
                                        }
                                    ).then((data)=>{
                                        console.log(data);
                                    location.reload();
                                    }).catch((error)=>{
                                        console.log(error)
                                    })
                                })
                                }) ;
                                </script>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{getPrice($product->subtotal())}}</p>
							</td>
							<td class="cart_delete">

                                <form action="{{route('cart.destroy',$product->rowId)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default check_out">
                                   <i class="fa fa-times"></i></a>
                                </form>
							</td>
                        </tr>
                        @endforeach
                        @else
                        <?php
                        Session::flash('danger','VOTRE PANIER EST VIDE');
                        ?>
                        @endif


					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">

			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								SI VOUS DETENEZ UN CODE COUPON VEUILLEZ ENTRER CE CODE DANS LE CHAMP CI-DESSOUS PUIS VALIDER
							</li>
                        </ul>

                        @if(!request()->session()->has('coupon'))
                        <form action="{{ route('cart.store.coupon') }}" method="POST">
                            <ul class="user_info">

                                    @csrf
                                <li class="single_field zip-field">
                                    <label>CODE COUPON:</label>
                                    <input type="text" placeholder="Entrer votre code ici" name="code">
                                    <button type="submit" class="btn btn-default check_out">VALIDER</button>
                                </li>

                            </ul>

                        </form>
                        @else
                        <ul class="user_option">
							<li>
								UN COUPON EST DEJA APLLIQUE.
							</li>
                        </ul>
                              

                        @endif
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Prix total <span>{{ getPrice(Cart::subtotal()) }}</span></li>
                           @if (request()->session()->has('coupon'))
                           <li>Coupon {{ request()->session()->get('coupon')['code'] }}
                            <span><form action="{{ route('cart.destroy.coupon') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                  </svg></button>
                             </form></span>
                                <span>{{ getPrice(request()->session()->get('coupon')['remise']) }}</span></li>
                                <li>Nouveau total <span>{{ getPrice(Cart::total() - request()->session()->get('coupon')['remise']) }}</span></li>
                                <li>Taxe <span>{{ getPrice(Cart::total() - request()->session()->get('coupon')['remise'] * (config('cart.tax') /100)) }}</span></li>
                                <li>Total <span>{{ getPrice(Cart::total() - request()->session()->get('coupon')['remise']
                                +(Cart::total() - request()->session()->get('coupon')['remise'] * (config('cart.tax') /100))) }}</span></li>
                           @else
                            <li>Taxe <span>{{ getPrice(Cart::tax()) }}</span></li>
							<li>Total <span>{{ getPrice(Cart::total()) }}</span></li>
						</ul>
                        @endif
                            <a class="btn btn-default check_out" href="{{route('checkout.index')}}">Commander</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<footer id="footer"><!--Footer-->


		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Service Après vente</a></li>
								<li><a href="#">Contactez</a></li>
								<li><a href="#">Disponible 24h/24</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Articles</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Ordinateur Portable</a></li>
								<li><a href="#">Clé USB</a></li>
								<li><a href="#">Mémoires RAM </a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Marques</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">HP</a></li>
								<li><a href="#">Lenovo</a></li>
								<li><a href="#">Acer</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Categories</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Contact</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">+228 93-24-02-55/98-88-66-29</a></li>
								<li><a href="#">kkinfo@email.com</a></li>
								<li><a href="#">Lomé,TOGO</a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">

				</div>
			</div>
        </div>


	</footer><!--/Footer-->



    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
