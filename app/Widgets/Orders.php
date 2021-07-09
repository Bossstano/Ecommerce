<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class  Orders extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Order::count();
        $string = 'Commandes';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-buy',
            'title'  => "{$count} {$string}",
            'text'   => "Vous avez {$count} commandes enregistrées. Cliquez sur le bouton ci-dessous pour afficher toutes les commandes.",
            'button' => [
                'text' => 'Commandes',
                'link' => route('voyager.orders.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
