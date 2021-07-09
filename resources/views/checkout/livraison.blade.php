
@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <section id="cart_items">
                        <div class="container">

                            <div class="table-responsive cart_info">
                                <table class="table table-condensed" >
                                    <thead>
                                        <tr class="cart_menu">
                                            <td class="image">NOM</td>
                                            <td class="description">PRENOM</td>
                                            <td class="price">ZONE DE LIVRAISON</td>
                                            <td class="quantity">CONTACT WHATSAPP</td>
                                            <td class="total">EMAIL</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($livreur as $livreur )
                                        <tr>
                                            <td class="cart_product">
                                               {{ $livreur->Nom }}
                                            </td>
                                            <td class="cart_description">
                                                {{ $livreur->Prenom }}
                                            </td>
                                            <td class="cart_price">
                                                {{ $livreur->zone }}
                                            </td>
                                            <td class="cart_quantity">
                                                {{ $livreur->tel }}
                                            </td>
                                            <td class="cart_total">
                                                {{ $livreur->email }}
                                            </td>
                                            
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @endsection



