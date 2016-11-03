<?php

namespace BoardingPassSorter\Pass;

use BoardingPassSorter\Pass;
use BoardingPassSorter\Point\Departure;
use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Vehicle\Train;
use ValueObjects\DateTime\DateTime;
use ValueObjects\Geography\Address;
use ValueObjects\Geography\Street;
use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\StringLiteral\StringLiteral;

class StackTest extends \PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
    }

    protected function getRandomAddress()
    {
        return new Address(
            new StringLiteral('Address'),
            new Street(new StringLiteral($this->faker->streetName), new StringLiteral($this->faker->buildingNumber)),
            new StringLiteral($this->faker->state),
            new StringLiteral($this->faker->city),
            new StringLiteral($this->faker->stateAbbr),
            new StringLiteral($this->faker->postcode),
            new Country(CountryCode::IT())
        );
    }

    public function testInitStackWithOneElement()
    {
        $departureAddress = $this->getRandomAddress();
        $arrivalAddress   = $this->getRandomAddress();
        
        $origin = new Departure(
            $departureAddress,
            DateTime::fromNative(2016, 'January', 1, 15, 0, 0),
            DateTime::fromNative(2016, 'January', 1, 10, 0, 0),
            new StringLiteral($this->faker->lexify('Gate ?'))
        );
        $destination = new Arrival(
            $arrivalAddress,
            DateTime::fromNative(2016, 'February', 1, 0, 0, 0),
            new StringLiteral($this->faker->lexify('Gate ?'))
        );
        $train = new Train(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass($origin, $destination, $train);

        $stack = new Stack([$bpass]);

        $this->assertCount(1, $stack);
    }

    public function testInitEmptyStackThenAddOneElement()
    {
        $departureAddress = $this->getRandomAddress();
        $arrivalAddress   = $this->getRandomAddress();
        
        $origin = new Departure(
            $departureAddress,
            DateTime::fromNative(2016, 'January', 1, 15, 0, 0),
            DateTime::fromNative(2016, 'January', 1, 10, 0, 0),
            new StringLiteral($this->faker->lexify('Gate ?'))
        );
        $destination = new Arrival(
            $arrivalAddress,
            DateTime::fromNative(2016, 'February', 1, 0, 0, 0),
            new StringLiteral($this->faker->lexify('Gate ?'))
        );
        $train = new Train(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass($origin, $destination, $train);

        $stack = new Stack();
        $stack->push($bpass);

        $this->assertCount(1, $stack);
    }

    public function testCheckDataIntoStack()
    {
        $departureAddress = $this->getRandomAddress();
        $arrivalAddress   = $this->getRandomAddress();
        
        $origin = new Departure(
            $departureAddress,
            DateTime::fromNative(2016, 'January', 1, 15, 0, 0),
            DateTime::fromNative(2016, 'January', 1, 10, 0, 0),
            new StringLiteral($this->faker->lexify('Gate ?'))
        );
        $destination = new Arrival(
            $arrivalAddress,
            DateTime::fromNative(2016, 'February', 1, 0, 0, 0),
            new StringLiteral($this->faker->lexify('Gate ?'))
        );
        $train = new Train(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass($origin, $destination, $train);

        $stack = new Stack();
        $stack->push($bpass);

        $this->assertCount(1, $stack);
        $stack->rewind();
        $this->assertEquals($bpass, $stack->current());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The parameter $boardingPass must be an instance of PassInterface
     */
    public function testInvalidPush()
    {
        $stack = new Stack();
        $stack->push(new \stdClass);
    }
}
