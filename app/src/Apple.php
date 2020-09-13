<?php


namespace Laptop;


class Apple implements Laptop
{
    function getModel()
    {
        return 'Laptop model: Appple Macbook Pro';
    }

    function getMemory()
    {
        return 'Apple Memory 16GB';
    }

    function getProcessor()
    {
        return 'Apple Processor: Core i7 Gen X';
    }

    function getPrice()
    {
        return 'Apple $1000';
    }
}