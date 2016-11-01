<?php

namespace BoardingPassSorter\Stack;

use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;
use BoardingPassSorter\Vehicle\Train;
use BoardingPassSorter\Pass;
use \Mockery as m;

class SortedTest extends \PHPUnit_Framework_TestCase
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

        $stack = new Sorted($sorter, [$bpass]);

        $this->assertCount(1, $stack);
    }

    public function testInitSortedStackWithTwoElement()
    {
        $bpass1 = $this->getRandomBoardingPass();
        $bpass2 = $this->getRandomBoardingPass();

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn([$bpass1, $bpass2]);

        $stack = new Sorted($sorter, [$bpass1, $bpass2]);

        $this->assertCount(2, $stack);
    }

    public function testInitSortedStackWithThreeElement()
    {
        $bpass1 = $this->getRandomBoardingPass();
        $bpass2 = $this->getRandomBoardingPass();
        $bpass3 = $this->getRandomBoardingPass();

        $sorter = m::mock('BoardingPassSorter\\Sorter\\SorterInterface[sort]');
        $sorter->shouldReceive('sort')->times(1)->andReturn([$bpass1, $bpass2, $bpass3]);

        $stack = new Sorted($sorter, [$bpass1, $bpass2, $bpass3]);

        $this->assertCount(3, $stack);
    }
}
