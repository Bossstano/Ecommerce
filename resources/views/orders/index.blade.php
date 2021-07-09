
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
                                            <td class="image">DATE</td>
                                            <td class="description">IMAGE</td>
                                            <td class="price">ARTICLE</td>
                                            <td class="quantity">PRIX UNITAIRE</td>
                                            <td class="total">QUANTITE</td>
                                            <td class="total">PRIX TOTAL</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Auth()->user()->orders as $order)
                                        @foreach (unserialize($order->products) as $product )
                                        <tr>
                                            <td class="cart_product">
                                                {{ Carbon\Carbon::parse($order->payment_created_at)->format('d/m/Y à H:i ')}}
                                            </td>
                                            <td class="cart_description">
                                                <a href=""><img src="{{asset('storage/'.$product[0])}}" height="100" width="100" alt=""></a>
                                            </td>
                                            <td class="cart_price">
                                                <p>{{ $product[1] }}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                {{ $product[2] }}
                                            </td>
                                            <td class="cart_total">
                                                {{ $product[3] }}
                                            </td>
                                            <?php
                                            $i =  $product[2] ;
                                            $j = $product[3];
                                            $t = $i *  $j;
                                            ?>
                                            <td class="cart_delete">
                                                {{$t}}
                                            </td>
                                        </tr>
                                        @endforeach
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



