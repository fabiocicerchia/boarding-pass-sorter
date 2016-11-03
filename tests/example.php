<?php

require_once __DIR__ . '/../vendor/autoload.php';

$api = new \BoardingPassSorter\Api();
$stack = $api->createEmptyStack();

$stack->push(\BoardingPassSorter\Pass\Factory::createPass([
    'origin'      => [
        'name'           => 'Rome',
        'streetName'     => 'Piazza dei Cinquecento',
        'buildingNumber' => '1',
        'state'          => 'Italy',
        'city'           => 'Rome',
        'state'          => 'Rome',
        'postcode'       => '00100',
        'countryCode'    => 'IT',
        'departure'      => '2016-01-01 11:00:00',
        'boarding'       => '2016-01-01 10:00:00',
        'location'       => 'Binario 1',
    ],
    'destination' => [
        'name'           => 'London',
        'streetName'     => 'Oxford Street',
        'buildingNumber' => '1',
        'state'          => 'UK',
        'city'           => 'London',
        'state'          => 'London',
        'postcode'       => 'W1D',
        'countryCode'    => 'GB',
        'arrival'        => '2016-01-01 13:00:00',
        'location'       => 'Exit 1',
    ],
    'seat'        => '1A',
    'vehicle'     => [
        'type'        => 'airplane',
        'identifier'  => 'FR3005',
    ],
    'details' => [
        'gate' => 'A',
        'note' => 'Possible strike action',
    ],
]));

// ...

$route = $api->getRoute($stack);
echo $api->describe($route);
