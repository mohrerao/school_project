<?php


namespace Laptop;


class Lenovo implements \Laptop\Laptop
{

    function getModel()
    {
        return 'Laptop model: Lenovo Thinkpad';
    }

    function getMemory()
    {
        return 'Lenovo Memory: 8GB';
    }

    function getProcessor()
    {
        return 'Lenovo Processor: Core i7 Gen X';
    }

    function getPrice()
    {
        return 'Lenovo $600';
    }
}