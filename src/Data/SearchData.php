<?php

namespace App\Data;

class SearchData 
{
    /**
     * @var string
     */
    public $q = '';

        /**
     * @var array|Brand []
     */
    public $brands = [];

     /**
     * @var null | integer
     */
    public $max;

    /**
     * @var null | integer
     */
    public $min;

    /**
    * @var null | integer
    */
   public $mileage;

        /**
     * @var boolean
     */
    public $promo = false;
}
