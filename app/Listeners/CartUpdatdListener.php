<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Coupon;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartUpdatdListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        $code = request()->session()->get('coupon');
        $coupon = Coupon::where('code',$code)->first();
        if($coupon){
            request()->session()->put('coupon',
            [
                'code'=> $coupon->code,
                'remise'=> $coupon->discount(Cart::subtotal())
            ]);
        }

    }
}
