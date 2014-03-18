<?php namespace Money;

use Session;

class Conversion {

    /**
     * This method will convert value from and to the given currencies
     *
     * @param $from
     * @param $to
     * @param $value
     * @return float
     */
    public function convert($from, $to, $value)
    {
        if($from == $to) return $value;

        return $this->getRate($from, $to) * $value;
    }


    /**
     * @param $from
     * @param $to
     * @throws ConversionException
     * @return float
     */
    public function getRate($from, $to)
    {

        // First we will check if we can get this rate from the session
        if($rate = $this->getFromSession($from, $to))
        {
            return $rate;
        }


        elseif($rate = $this->getRateFromSite($from, $to))
        {
            // We will save this rate to session to decrease number of requests to this site
            $this->saveToSession($from, $to, $rate);

            return $rate;
        }

        // If we couldn't get the rate for this currency we will throw an error
        throw new ConversionException("We couldn't convert our prices to this currency");
    }

    /**
     * @param $from
     * @param $to
     * @return float
     */
    protected function getRateFromSite($from, $to)
    {
        // Try to get the rate from the site.. Sometimes the site will be unavailable and this won't work
        try{
            $object = json_decode(file_get_contents('http://rate-exchange.appspot.com/currency?from='.$from.'&to='.$to));

            return $object->rate;

        }catch (\Exception $e){
        }
    }


    /**
     * @param $from
     * @param $to
     * @return mixed
     */
    protected function getFromSession($from, $to)
    {
        return Session::get('application_rates_'.$from.'_'.$to, false);
    }

    /**
     * @param $from
     * @param $to
     * @param $rate
     */
    protected function saveToSession($from, $to, $rate)
    {
        Session::put('application_rate_'.$from.'_'.$to, $rate);
    }
}