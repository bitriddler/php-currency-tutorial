<?php namespace Money;

use App;
use Session;

class Currency {

    /**
     * @var string
     */
    protected $code;

    /**
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    // We have two states for the currency. The default currency and the application current currency
    // The default currency is the currency you saved all the prices in the database with
    // The application currency is the one the user chooses it might be the default currency or another currency
    /**
     * @return Currency
     */
    public static function getDefault()
    {
        // This will be the default currency
        // All the prices in the database are saved related to this currency
        return new Currency('USD');
    }

    /**
     * Get the current currency or the default currency
     *
     * @return Currency
     */
    public static function getCurrent()
    {
        // We also want to use the GeoLocation class we created in the previous part to set the currency to the user
        // country currency code

        // This is acceptable in laravel and testable. But you can also inject it if you want

        // Get first from the session if it exists
        if($currency = Session::get('application_currency'))
        {
            return new Currency($currency);
        }

        // If this was the first time get the currency code dependin on the location
        $geoLocation = App::make('GeoLocation');

        if($currency = $geoLocation->getCurrencyCode())
        {
            static::changeCurrent($currency);

            return new Currency($currency);
        }

        // If it wasn't able to get the currency from the country then return the default currency
        return static::getDefault();
    }

    /**
     * @param $currency
     */
    public static function changeCurrent($currency)
    {
        Session::put('application_currency', $currency);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }
} 