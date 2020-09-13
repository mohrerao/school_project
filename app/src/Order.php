<?php


namespace Order;


use Laptop\LaptopFactory;

class LaptopOrder
{
    protected $laptop_orders = [];
    protected $laptop;

    public function __construct() {
        $this->laptop = new LaptopFactory();
    }

    public function order($model=NULL) {
        $laptop = $this->laptop->make($model);
        $this->laptop_orders[]=$laptop->getModel();
    }

    public function getLaptopOrders()
    {
        return $this->laptop_orders;
    }
}