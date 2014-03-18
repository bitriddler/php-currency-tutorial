<?php

use Money\Currency;
use Money\Price;

// We will use laravel IOC system to handle the creation of price and conversions
App::bind('Money\Price', function($app, $value)
{
    // Maybe this is not the best way but you can refactor this
    $defaultCurrency = Currency::getDefault();
    $currentCurrency = Currency::getCurrent();

    // If currencies are not the same then convert the value first
    if($defaultCurrency != $currentCurrency)
    {
        // We will first convert the value from the default currency to the current currency
        $value = $app->make('Money\Conversion')->convert($defaultCurrency, $currentCurrency, $value);
    }

    return new Price($value, Currency::getCurrent());
});