<?php

namespace BoardingPassSorter\Sorter;

use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;
use BoardingPassSorter\Vehicle\Train;
use BoardingPassSorter\Pass;
use \Mockery as m;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
    }

    protected function getRandomBoardingPass($originCity, $destinationCity)
    {
        $origin      = new Departure($originCity, $this->faker->dateTime(), $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $destination = new Arrival($destinationCity, $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $train       = new Train($this->faker->bothify('??###'));

        $bpass = new Pass($origin, $destination, $train);

        return $bpass;
    }

    public function testSortingWithOneElement()
    {
        $bpass = $this->getRandomBoardingPass('Rome', 'Milan');
        $list = [$bpass];
        shuffle($list);

        $sorter = new Location;
        $sortedStack = $sorter->sort($list);

        // there shouldn't really need to check if it's sorted
        $this->assertCount(1, $sortedStack);
    }

    public function testSortingWithTwoElement()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');

        $list = [$bpass1, $bpass2];
        shuffle($list);

        $sorter = new Location;
        $sortedStack = $sorter->sort($list);

        $this->assertCount(2, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack[0]);
        $this->assertEquals($bpass2, $sortedStack[1]);
    }

    public function testSortingWithThreeElement()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');
        $bpass3 = $this->getRandomBoardingPass('Turin', 'Venice');

        $list = [$bpass1, $bpass2, $bpass3];
        shuffle($list);

        $sorter = new Location;
        $sortedStack = $sorter->sort($list);

        $this->assertCount(3, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack[0]);
        $this->assertEquals($bpass2, $sortedStack[1]);
        $this->assertEquals($bpass3, $sortedStack[2]);
    }

    public function testSortingWithFourElement()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');
        $bpass3 = $this->getRandomBoardingPass('Turin', 'Venice');
        $bpass4 = $this->getRandomBoardingPass('Venice', 'New York');

        $list = [$bpass1, $bpass2, $bpass3, $bpass4];
        shuffle($list);

        $sorter = new Location;
        $sortedStack = $sorter->sort($list);

        $this->assertCount(4, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack[0]);
        $this->assertEquals($bpass2, $sortedStack[1]);
        $this->assertEquals($bpass3, $sortedStack[2]);
        $this->assertEquals($bpass4, $sortedStack[3]);
    }
}
