<?php

namespace BoardingPassSorter\Describer;

use BoardingPassSorter\Point\Departure;
use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Vehicle\Train;
use BoardingPassSorter\Vehicle\Bus;
use BoardingPassSorter\Vehicle\Airplane;
use BoardingPassSorter\Pass;
use BoardingPassSorter\Pass\Stack;
use ValueObjects\DateTime\DateTime;
use ValueObjects\Geography\Address;
use ValueObjects\Geography\Street;
use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\StringLiteral\StringLiteral;
use BoardingPassSorter\Sorter\Location;
use BoardingPassSorter\Describer\Route as RouteDescriber;
use BoardingPassSorter\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
    }

    public function testDescribeRealRoute()
    {
        $bpass = [];

        // Boarding Pass #1
        $milanoCentrale = new Address(
            new StringLiteral('Milano Centrale'),
            new Street(new StringLiteral('Piazza Duca d\'Aosta'), new StringLiteral('1')),
            new StringLiteral('Italia'),
            new StringLiteral('Milano'),
            new StringLiteral('Milano'),
            new StringLiteral('20124'),
            new Country(CountryCode::IT())
        );
        $romaTermini = new Address(
            new StringLiteral('Roma Termini'),
            new Street(new StringLiteral('Piazza dei Cinquecento'), new StringLiteral('1')),
            new StringLiteral('Italia'),
            new StringLiteral('Roma'),
            new StringLiteral('RM'),
            new StringLiteral('00185'),
            new Country(CountryCode::IT())
        );
        $origin      = new Departure($milanoCentrale, DateTime::fromNative(2016, 'January', 1, 15, 0, 0), DateTime::fromNative(2016, 'January', 1, 14, 30, 0), new StringLiteral($this->faker->lexify('Binario 1')));
        $destination = new Arrival($romaTermini, DateTime::fromNative(2016, 'January', 1, 18, 30, 0), new StringLiteral($this->faker->lexify('Binario 1')));
        $vehicle     = new Train(new StringLiteral('78A'));
        $bpass[]     = new Pass($origin, $destination, $vehicle, new StringLiteral('45B'));

        // Boarding Pass #2
        $romaFiumicino = new Address(
            new StringLiteral('Aeroporto Leonardo da Vinci–Fiumicino'),
            new Street(new StringLiteral('Via dell\'Aeroporto di Fiumicino'), new StringLiteral('320')),
            new StringLiteral('Italia'),
            new StringLiteral('Fiumicino'),
            new StringLiteral('Roma'),
            new StringLiteral('00054'),
            new Country(CountryCode::IT())
        );
        $origin      = new Departure($romaTermini, DateTime::fromNative(2016, 'January', 1, 19, 0, 0), DateTime::fromNative(2016, 'January', 1, 18, 45, 0), new StringLiteral($this->faker->lexify('Piattaforma 1')));
        $destination = new Arrival($romaFiumicino,DateTime::fromNative(2016, 'January', 1, 20, 0, 0), new StringLiteral($this->faker->lexify('Piattaforma 1')));
        $vehicle     = new Bus();
        $bpass[]     = new Pass($origin, $destination, $vehicle);

        // Boarding Pass #3
        $romaFiumicino = new Address(
            new StringLiteral('Aeroporto Leonardo da Vinci–Fiumicino'),
            new Street(new StringLiteral('Via dell\'Aeroporto di Fiumicino'), new StringLiteral('320')),
            new StringLiteral('Italia'),
            new StringLiteral('Fiumicino'),
            new StringLiteral('Roma'),
            new StringLiteral('00054'),
            new Country(CountryCode::IT())
        );
        $parigi = new Address(
            new StringLiteral('Aéroport de Paris-Charles-de-Gaulle'),
            new Street(new StringLiteral('Via dell\'Aeroporto di Fiumicino'), new StringLiteral('320')),
            new StringLiteral('Francia'),
            new StringLiteral('Parigi'),
            new StringLiteral('Roissy-en-France'),
            new StringLiteral('95700'),
            new Country(CountryCode::FR())
        );
        $origin      = new Departure($romaFiumicino, DateTime::fromNative(2016, 'January', 1, 22, 0, 0), DateTime::fromNative(2016, 'January', 1, 21, 30, 0), new StringLiteral($this->faker->lexify('45B')));
        $destination = new Arrival($parigi, DateTime::fromNative(2016, 'January', 2, 0, 10, 0), new StringLiteral($this->faker->lexify('Gate 10')));
        $vehicle     = new Airplane(new StringLiteral('SK455'));
        $details     = ['luggage' => 'Consegna bagaglio alla biglietteria 344'];
        $bpass[]     = new Pass($origin, $destination, $vehicle, new StringLiteral('3A'), $details);

        // Boarding Pass #4
        $newYork = new Address(
            new StringLiteral('John F. Kennedy International Airport'),
            new Street(new StringLiteral('Queens'), new StringLiteral('')),
            new StringLiteral('USA'),
            new StringLiteral('New York'),
            new StringLiteral('Queens'),
            new StringLiteral('11430'),
            new Country(CountryCode::US())
        );
        $origin      = new Departure($parigi, DateTime::fromNative(2016, 'January', 2, 10, 0, 0), DateTime::fromNative(2016, 'January', 2, 9, 30, 0), new StringLiteral($this->faker->lexify('22')));
        $destination = new Arrival($newYork, DateTime::fromNative(2016, 'January', 2, 18, 30, 0), new StringLiteral($this->faker->lexify('Gate 5')));
        $vehicle     = new Airplane(new StringLiteral('SK22'));
        $details     = ['luggage' => 'Bagaglio trasferito automaticamente dall\'ultima tratta'];
        $bpass[]     = new Pass($origin, $destination, $vehicle, new StringLiteral('7B'), $details);

        shuffle($bpass);

        $stack = new Stack();
        foreach ($bpass as $item) {
            $stack->push($item);
        }

        $sorter = new Location();

        $route = new Route($sorter, $stack);

        $steps = 'Prendere il treno 78A da Milano a Roma. Posto assegnato 45B.' . PHP_EOL;
        $steps .= 'Prendere l\'autobus da Roma a Fiumicino. Nessuna assegnazione del posto.' . PHP_EOL;
        $steps .= 'Dall\'aeroporto di Fiumicino, prendere il volo SK455 per Parigi. Imbarco 45B, posto 3A. Consegna bagaglio alla biglietteria 344.' . PHP_EOL;
        $steps .= 'Dall\'aeroporto di Parigi, prendere il volo SK22 per New York. Imbarco 22, posto 7B. Bagaglio trasferito automaticamente dall\'ultima tratta.';
        $this->assertEquals($steps, strval(new RouteDescriber($route)));
    }
}
