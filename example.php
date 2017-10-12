<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->areasList());
