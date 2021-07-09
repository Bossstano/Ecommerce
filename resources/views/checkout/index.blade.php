







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout | E-Shopper</title>

    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
    <script src="https://js.stripe.com/v3/"></script>

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
								<li><a href=""><i class="fa fa-phone"></i> </a></li>
								<li><a href=""><i class="fa fa-envelope"></i> </a></li>
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

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ route('products.index') }}" class="active">Acceuil</a></li>
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

					</div>
					<div class="col-sm-3">

					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">

			</div><!--/breadcrums-->




            <br><br>

			<div class="row">
                <form method="POST" action="{{ route('checkout.store') }}" class="my-4" id="payment-form">
                    @csrf
                <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                <div id="card-errors" role="alert"><!--Stripe.js injects the Error message--></div>
                <button id="submit" class=" btn btn-primary">

                  <span id="button-text">PROCEDER AU PAYEMENT({{ getPrice($total) }})</span>
                </button>
                </form>
            </div>
<br><br><br><br><br><br>

	</section> <!--/#cart_items-->



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
    <script>
        var stripe = Stripe("pk_test_51HL9cDFuorsFn2kjYQw6p4G5zUqKhRd4lk7HFRSYgtYwvj9cERvwJukpjamCCndh6PXGA9Bd3MktEq3jHaVujKue00MM9Ep04F");
        var elements = stripe.elements();
        var style = {
       base: {
        color: "#32325d",
        fontFamily: 'Arial, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
        }
        },  invalid: {
          fontFamily: 'Arial, sans-serif',
        color: "#fa755a",
      }
      };
      var card = elements.create("card", { style: style });

    card.mount("#card-element");
    card.addEventListener('change',({error})=>{const displayError = document.getElementById('card-errors');
  if(error){
      displayError.classList.add('alert','alert-warning');
      displayError.textContent = error.message;
           }
else{
    displayError.classList.add('alert','alert-warning');
      displayError.textContent = '';
   }
});
var submitButton = document.getElementById('submit');

submitButton.addEventListener('click',function(ev){
    ev.preventDefault();
    submitButton.disabled = true;
    stripe.confirmCardPayment("{{$clientSecret}}",{
        payment_method:{
            card:card
        }
    }).then(function(result){
        if (result.error){
            submitButton.disabled = false;
            console.log(result.error.message);}
        else{
            if (result.paymentIntent.status==='succeeded')
            {
            var paymentIntent = result.paymentIntent;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var form = document.getElementById('payment-form');
            var url = form.action;


           fetch(
                url,
                {
                    headers:{
                        "Content-Type":"application/json",
                        "Accept":"application/json ,text-plain, */*",
                        "X-Requested-With":"XMLHttpRequest",
                        "X-CSRF-TOKEN": token,
                    },
                    method:'post',
                    body: JSON.stringify({paymentIntent: paymentIntent})
                }
            ).then((data)=>{
                if(data-status===400){
                    var redirect = '/boutique';
                }else{
                    var redirect = '/merci';
                }
            //console.log(data);
            //form.reset();
            window.location.href = redirect;
            }).catch((error)=>{
                console.log(error)
                })
            }
          //  console.log(result.paymentIntent);}
        }
    });
});
    </script>
</body>
</html>

