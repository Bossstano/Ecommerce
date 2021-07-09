<?php

    function getPrice($priceInDecimals)
    {

    $price = floatval($priceInDecimals)/1000;

    return number_format($price,3,'.',' ').'FCFA';
    }

