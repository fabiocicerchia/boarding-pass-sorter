<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;
use BoardingPassSorter\Vehicle\Train;
use BoardingPassSorter\Pass;
use \Mockery as m;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
    }

    protected function getRandomBoardingPass()
    {
        $origin      = new Departure($this->faker->city, $this->faker->dateTime(), $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $destination = new Arrival($this->faker->city, $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $train       = new Train($this->faker->bothify('??###'));

        $bpass = new Pass($origin, $destination, $train);

        return $bpass;
    }

    public function testInitSortedStackWithOneElement()
    {
        $bpass = $this->getRandomBoardingPass();

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn([$bpass]);

        $stack = new Stack([$bpass]);
        $route = new Route($sorter, $stack);

        $this->assertCount(1, $route->getLegs());
    }

    public function testInitSortedStackWithTwoElement()
    {
        $bpass1 = $this->getRandomBoardingPass();
        $bpass2 = $this->getRandomBoardingPass();

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn([$bpass1, $bpass2]);

        $stack = new Stack([$bpass1, $bpass2]);
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

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn([$bpass1, $bpass2, $bpass3]);

        $stack = new Stack([$bpass1, $bpass2, $bpass3]);
        $route = new Route($sorter, $stack);

        $this->assertCount(3, $route->getLegs());
        $this->assertEquals($bpass1, $route->getStart());
        $this->assertEquals($bpass3, $route->getEnd());
    }
}
