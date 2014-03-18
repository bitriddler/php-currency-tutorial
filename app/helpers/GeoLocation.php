<?php

class GeoLocation {

    /**
     * This will return the currency code depending on the country
     *
     * Since I am testing this on my local machine . my ip will be 127.0.0.1 So this will not get a valid result
     *
     * But I tested this on a real life application and it works
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        $ip_data = $this->getData();

        if($ip_data && $ip_data->geoplugin_currencyCode != null)
        {
            return $ip_data->geoplugin_currencyCode;
        }
    }


    public function getData()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

        return $ip_data;
    }

} 