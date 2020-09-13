<?php

require "/Users/kiran.rao/Sites/School_project/vendor/autoload.php";
require "/Users/kiran.rao/Sites/School_project/src/Order.php";

use Order\LaptopOrder;

$order = new LaptopOrder();
$order->order('Apple');
$order->order('Lenovo');
print_r($order->getLaptopOrders());
