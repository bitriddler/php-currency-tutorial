<?php

use Money\Price;

class Product extends Eloquent {

    protected $table = 'products';


    protected $fillable = array('title', 'price');

    /**
     * @var Price
     */
    protected $priceObject;

    /**
     * @return Price
     */
    public function getPrice()
    {
        // Create a price object only the first time for each product
        if(! $this->priceObject) $this->priceObject = App::make('Money\Price', $this->attributes['price']);

        return $this->priceObject;
    }

} 