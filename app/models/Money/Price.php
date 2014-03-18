<?php namespace Money;

class Price {

    /**
     * @var float
     */
    protected $value;

    /**
     * @var Currency
     */
    protected $currency;

    /**
     * @param $value
     * @param Currency $currency
     */
    public function __construct($value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function value()
    {
        return number_format($this->value, 2);
    }

    /**
     * @return string
     */
    public function format()
    {
        return $this->currency .' '. $this->value();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format();
    }
}