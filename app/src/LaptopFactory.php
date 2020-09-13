<?php


namespace Laptop;


class LaptopFactory
{
    protected $laptop;

    public function make($model = Null) {
        switch ($model) {
            case 'Lenovo':
                $this->laptop = new Lenovo();
                break;
            case 'Apple':
                $this->laptop = new Apple();
                break;
        }
        return $this->laptop;
    }
}