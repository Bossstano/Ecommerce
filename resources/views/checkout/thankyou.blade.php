
 @if (session('success'))
 <div class="alert alert-success">
     {{session('success')}}
 </div>
@endif


<!DOCTYPE html>
<html>
<head>

  <style type="text/css">
    .float{
      float: left;
      text-align: center;
      font-size: xx-small;
    }
    .float_right{
      float: right;

    }
    .rep{

      text-align: center;
      font-size: x-small;
    }
    .rep1{
      font: bold;

      text-align: center;
      font-size: small;
    }
    .line1{
      border: 0.5px solid;
    }
    .line2{
      border: 1.5px solid;

    }
    .title{
            text-align: center;
            font: bold;

    }
    .fieldset1{
      border-radius: 10px;
      width: 350px;
      float: left;
      position: relative;
      top: 10px;
      bottom: 50px;
    }
    .fieldset2{
      border-radius: 10px;
      width: 200px;
      margin-left: 385px;
    }
    table{
      border-collapse: collapse;

    }
    td,th{
      border:2px solid black;
    }
    .br{
      line-height: 10px;
    }

    input {
      position: absolute;
    }

    #filigrane {
      position: fixed;
      top: 22%;
      text-align: center;

      transform: rotate(10deg);
      transform-origin: 50% 50%;
      z-index: -1000;
    }

    .tabcenter{
     margin-left:auto;
     margin-right:auto;
    }

    td
    {
      text-align: center;
    }

    th
    {
      text-align: center;
    }
    #MaTable {
     width: 100%;
     padding: 2px;
     border-spacing: 2px;
    }

    tbody {
      font-size: 90%;
      font-style: italic;
    }

    tfoot {
      font-weight: bold;
    }

    html {
  font-family: sans-serif;
}

table {
  border-collapse: collapse;
  border: 2px solid rgb(200,200,200);
  letter-spacing: 1px;
  font-size: 0.8rem;
}

td, th {
  border: 1px solid rgb(190,190,190);
  padding: 10px 20px;
}

th {
  background-color: rgb(235,235,235);
}

td {
  text-align: center;
}

tr:nth-child(even) td {
  background-color: rgb(250,250,250);
}

tr:nth-child(odd) td {
  background-color: rgb(245,245,245);
}

caption {
  padding: 10px;
}
  </style>
  <title></title>
</head>
<body>





&nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;  &nbsp;

<br>
<div style="float: left;">
 KAF KAF INFORMATIQUE <br> T&eacute;l : +228 93-24-02-55/98-88-66-29<br>
 E-mail : kkinfo@email.com<br>
 Lomé,TOGO<br>
Ventes d'articles informatiques

</div><br> <br> <br> <br>


<center></center> <br> <br>





<h3 style="float: right;">Facture N° 00{{ $fact}} </h3> <br><br>
<hr color="blue" size="4"> <br><h4 align="right">Date : {{date("d-m-Y")}}</h4>
<h4>Client : {{ $name}} </h4>
<h4>E-mail du client : {{ $mail}} </h4>

<table id="MaTable" class="tabcenter" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">

  <thead>
    <tr>
      <th>Nom produit</th>
      <th>prix unitaire</th>
      <th>Quantité achetée</th>
      <th>Total achat</th>


    </tr>
  </thead>

        <?php
          $somme = 0;
          $tax = 0;
          $remise = 0;
        ?>

       @foreach($products as $product)
        <tr BGCOLOR="#CCCCCC">
          <td>{{ $product[1] }}</td>
          <td>{{ getprice($product[2]) }}</td>
          <td>{{ $product[3] }}</td>
          <?php
         $total = $product[2] * $product[3];
         $somme+=$total;
          ?>
          <td> {{ getprice($total) }}</td>




        </tr>
        @endforeach


    </tbody><tfoot>
        <tr>
            <td colspan="3">Somme sans taxe et remise</td>
            <td>{{ getprice($somme) }}</td>
          </tr>
      <tr>
        <td colspan="3">Taxe de 18% :</td>
        <?php
        $tax = $somme * 0.18
        ?>
        <td>{{ getprice($tax) }}</td>
      </tr>
      <tr>
        <td colspan="3">Remise</td>
        <?php
        $remise = $montant - $tax - $total;
        ?>
        <td>{{ getprice($remise) }}</td>
      </tr>
      <tr>
        <td colspan="3">Total à payer</td>
        <td>{{ getprice($montant) }}</td>
      </tr>
    </tfoot>

   <tbody>

</table> <br>

<b>Arrêtée la présente facture à la somme de : {{ getprice($montant) }} Franc CFA</b> <br>

<div style="float: left;;" style="position: absolute; bottom: 0;width: 100%; padding-top: 50px; height: 50px;">



       <h4 align="left"></h4>


  </div>
  <br> <br> <br> <br> <br><br><br>


  <div>
    <footer style="position: absolute; bottom: 0;width: 100%; padding-top: 50px; height: 50px;">
      <hr color="blue" size="4" align="center">
      <div style="float: left;;">

      </div>
      <div style="float: right;;">
        Tél : +228 93-24-02-55/98-88-66-29
      </div>

    </footer>
    <div><h3>MERCI POUR LA COMMANDE EFFECTUEE,VEUILLEZ CLIQUER SUR LE BOUTTON POUR TELECHARGER LA FACTURE </h3>
    <a href="{{ route('checkout.download')}}"> <button  type="submit">TELECHARGER</button></a><br>
    </div>
    <div><h3>VEUILLEZ CLIQUER SUR LE BOUTTON POUR CONSULTER LA LISTE DES LIVREURS </h3>
        <a href="{{ route('checkout.livreur')}}"> <button  type="submit">LISTER</button></a><br>
        </div>
  </div>
</body>
</html>









