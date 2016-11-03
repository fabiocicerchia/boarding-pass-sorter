# Boarding Passes Sorter

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fabiocicerchia/boarding-pass-sorter/badges/quality-score.png)](https://scrutinizer-ci.com/g/fabiocicerchia/boarding-pass-sorter/)
[![Build Status](https://travis-ci.org/fabiocicerchia/boarding-pass-sorter.svg?branch=master)](https://travis-ci.org/fabiocicerchia/boarding-pass-sorter)
[![PHP 7 ready](http://php7ready.timesplinter.ch/fabiocicerchia/boarding-pass-sorter/master/badge.svg)](https://travis-ci.org/fabiocicerchia/boarding-pass-sorter)
![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)

## About the Challenge

Abbiamo una serie di carte d'imbarco per vari mezzi di trasporto, che porteranno da un punto A a un punto B, con varie fermate lungo il percorso. Le carte d'imbarco non sono in ordine, non si sa dove inizia il viaggio, né dove finisce. Ogni carta d'imbarco contiene informazioni sull'assegnazione del posto e sui mezzi di trasporto (numero di volo, di autobus, ecc). Bisogna scrivere una API che permetta di ordinare questo tipo di lista e presentare una descrizione di come completare il nostro viaggio. Per esempio l'API dovrebbe essere in grado di prendere un insieme non ordinato di carte d'imbarco, fornite in un formato a scelta, e produrre questa lista:
1. Prendere il treno 78A da Milano a Roma. Posto assegnato 45B.
2. Prendere l'autobus da Roma a Fiumicino aeroporto. Nessuna assegnazione del posto.
3. Dall'aeroporto di Fiumicino, prendere il volo SK455 per Parigi. Imbarco 45B, posto 3A. Consegna bagaglio alla biglietteria 344.
4. Da Parigi, prendere il volo SK22 New York JFK. Imbarco 22, posto 7B. Bagaglio trasferito automaticamente dall'ultima tratta.
5. Destinazione finale.

## Install

    composer install

## Example

    require_once __DIR__ . '/../vendor/autoload.php';

    $api = new \BoardingPassSorter\Api;
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
            'note' => 'Possible strike action'
        ]
    ]));

    // ...

    $route = $api->getRoute($stack);
    echo $api->describe($route);

## Run the Tests

    ./vendor/bin/paratest

or

    ./vendor/bin/phpunit

## License

This repo is licensed under the MIT license.
