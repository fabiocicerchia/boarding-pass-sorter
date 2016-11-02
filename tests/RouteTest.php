<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Point\Departure;
use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Vehicle\Train;
use BoardingPassSorter\Pass;
use BoardingPassSorter\Pass\Stack;
use ValueObjects\DateTime\DateTime;
use ValueObjects\Geography\Address;
use ValueObjects\Geography\Street;
use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\StringLiteral\StringLiteral;
use \Mockery as m;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
    }
    
    protected function getRandomAddress()
    {
        return new Address(
            new StringLiteral($this->faker->city),
            new Street(new StringLiteral($this->faker->streetName), new StringLiteral($this->faker->buildingNumber)),
            new StringLiteral($this->faker->state),
            new StringLiteral($this->faker->city),
            new StringLiteral($this->faker->stateAbbr),
            new StringLiteral($this->faker->postcode),
            new Country(CountryCode::IT())
        );
    }

    protected function getRandomBoardingPass()
    {
        $origin      = new Departure($this->getRandomAddress(), DateTime::fromNativeDateTime(new \DateTime('2016-01-01 15:00:00')), DateTime::fromNativeDateTime(new \DateTime('2016-01-01 10:00:00')), new StringLiteral($this->faker->lexify('Gate ?')));
        $destination = new Arrival($this->getRandomAddress(), DateTime::fromNativeDateTime(new \DateTime('2016-02-01')), new StringLiteral($this->faker->lexify('Gate ?')));
        $train       = new Train(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass($origin, $destination, $train);

        return $bpass;
    }

    public function testInitSortedStackWithOneElement()
    {
        $bpass = $this->getRandomBoardingPass();

        $stack = new Stack();
        $stack->push($bpass);

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn($stack);
        
        $route = new Route($sorter, $stack);

        $this->assertCount(1, $route->getLegs());
    }

    public function testInitSortedStackWithTwoElement()
    {
        $bpass1 = $this->getRandomBoardingPass();
        $bpass2 = $this->getRandomBoardingPass();

        $stack = new Stack();
        $stack->push($bpass1);
        $stack->push($bpass2);

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn($stack);
        
        $route = new Route($sorter, $stack);

        $this->assertCount(2, $route->getLegs());
        $this->assertEquals($bpass1, $route->getStart());
        $this->assertEquals($bpass2, $route->getEnd());
    }

    public function testInitSortedStackWithThreeElement()
    {
        $bpass1 = $this->getRandomBoardingPass();
        $bpass2 = $this->getRandomBoardingPass();
        $bpass3 = $this->getRandomBoardingPass();

        $stack = new Stack();
        $stack->push($bpass1);
        $stack->push($bpass2);
        $stack->push($bpass3);

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn($stack);
        
        $route = new Route($sorter, $stack);

        $this->assertCount(3, $route->getLegs());
        $this->assertEquals($bpass1, $route->getStart());
        $this->assertEquals($bpass3, $route->getEnd());
    }
}
