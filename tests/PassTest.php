<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Point\Departure;
use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Vehicle\Airplane;
use BoardingPassSorter\Vehicle\Bus;
use BoardingPassSorter\Vehicle\Train;
use ValueObjects\DateTime\DateTime;
use ValueObjects\Geography\Address;
use ValueObjects\Geography\Street;
use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Structure\Collection;
use ValueObjects\Structure\KeyValuePair;

class PassTest extends \PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
    }
    
    protected function getRandomAddress($name)
    {
        return new Address(
            new StringLiteral($name),
            new Street(new StringLiteral($this->faker->streetName), new StringLiteral($this->faker->buildingNumber)),
            new StringLiteral($this->faker->state),
            new StringLiteral($name),
            new StringLiteral($this->faker->stateAbbr),
            new StringLiteral($this->faker->postcode),
            new Country(CountryCode::IT())
        );
    }
    
    public function testCreateSimpleBoardingPass()
    {
        $origin = new Departure(
            $this->getRandomAddress('Point A'),
            DateTime::fromNative(2016, 'January', 1, 13, 0, 0), // departure
            DateTime::fromNative(2016, 'January', 1, 12, 40, 0), // boarding
            new StringLiteral('Gate A') // location
        );
        $destination = new Arrival(
            $this->getRandomAddress('Point B'),
            DateTime::fromNative(2016, 'January', 2, 10, 0, 0), // arrival
            new StringLiteral('Gate F') // location
        );

        $train = new Train(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass($origin, $destination, $train);

        $this->assertEquals('Point A', $bpass->getOrigin()->getCity());
        $this->assertSame('2016-01-01 13:00', $bpass->getOrigin()->getTime()->toNativeDateTime()->format('Y-m-d H:i'));
        $this->assertSame('2016-01-01 12:40', $bpass->getOrigin()->getBoarding()->toNativeDateTime()->format('Y-m-d H:i'));
        $this->assertEquals('Gate A', $bpass->getOrigin()->getLocation());

        $this->assertEquals('Point B', $bpass->getDestination()->getCity());
        $this->assertSame('2016-01-02', $bpass->getDestination()->getTime()->toNativeDateTime()->format('Y-m-d'));
        $this->assertEquals('Gate F', $bpass->getDestination()->getLocation());
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The departure date cannot be after the arrival date
     */
    public function testCreateInvalidBoardingPassWithArrivalInThePast()
    {
        $origin = new Departure(
            $this->getRandomAddress('Point A'),
            DateTime::fromNative(2016, 'January', 1, 13, 0, 0), // departure
            DateTime::fromNative(2016, 'January', 1, 12, 40, 0), // boarding
            new StringLiteral('Gate A') // location
        );
        $destination = new Arrival(
            $this->getRandomAddress('Point B'),
            DateTime::fromNative(2015, 'December', 31, 10, 0, 0), // arrival
            new StringLiteral('Gate F') // location
        );

        $train = new Train(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass($origin, $destination, $train);
    }

    public function testCreateBoardingPassWithSeat()
    {
        $origin = new Departure(
            $this->getRandomAddress('Point A'),
            DateTime::fromNative(2016, 'January', 1, 13, 0, 0) // departure
        );
        $destination = new Arrival(
            $this->getRandomAddress('Point B'),
            DateTime::fromNative(2016, 'January', 2, 10, 0, 0) // arrival
        );

        $airplane = new Airplane(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass(
            $origin,
            $destination,
            $airplane,
            new StringLiteral('I6')
        );

        $this->assertEquals('Point A', $bpass->getOrigin()->getCity());
        $this->assertSame('2016-01-01', $bpass->getOrigin()->getTime()->toNativeDateTime()->format('Y-m-d'));

        $this->assertEquals('Point B', $bpass->getDestination()->getCity());
        $this->assertSame('2016-01-02', $bpass->getDestination()->getTime()->toNativeDateTime()->format('Y-m-d'));

        $this->assertEquals('I6', $bpass->getSeat());
    }

    public function testCreateBoardingPassWithSeatAndDetails()
    {
        $origin = new Departure(
            $this->getRandomAddress('Point A'),
            DateTime::fromNative(2016, 'January', 1, 13, 0, 0) // departure
        );
        $destination = new Arrival(
            $this->getRandomAddress('Point B'),
            DateTime::fromNative(2016, 'January', 2, 10, 0, 0) // arrival
        );

        $bus = new Bus(new StringLiteral($this->faker->bothify('###')));

        $bpass = new Pass(
            $origin,
            $destination,
            $bus,
            new StringLiteral('I6'),
            [
                'note' => 'Possible strike on departure date'
            ]
        );

        $this->assertEquals('Point A', $bpass->getOrigin()->getCity());
        $this->assertSame('2016-01-01', $bpass->getOrigin()->getTime()->toNativeDateTime()->format('Y-m-d'));

        $this->assertEquals('Point B', $bpass->getDestination()->getCity());
        $this->assertSame('2016-01-02', $bpass->getDestination()->getTime()->toNativeDateTime()->format('Y-m-d'));

        $this->assertEquals('I6', $bpass->getSeat());
        $this->assertCount(1, $bpass->getDetails());
    }
}
