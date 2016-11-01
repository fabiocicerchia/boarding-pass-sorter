<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;
use BoardingPassSorter\Vehicle\Train;

class StackTest extends \PHPUnit_Framework_TestCase
{
    protected $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create();
    }

    public function testInitStackWithOneElement()
    {
        $origin      = new Departure($this->faker->city, $this->faker->dateTime(), $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $destination = new Arrival($this->faker->city, $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $train       = new Train($this->faker->bothify('??###'));

        $bpass = new Pass($origin, $destination, $train);

        $stack = new Stack([$bpass]);

        $this->assertCount(1, $stack);
    }

    public function testInitEmptyStackThenAddOneElement()
    {
        $origin      = new Departure($this->faker->city, $this->faker->dateTime(), $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $destination = new Arrival($this->faker->city, $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $train       = new Train($this->faker->bothify('??###'));

        $bpass = new Pass($origin, $destination, $train);

        $stack = new Stack();
        $stack->push($bpass);

        $this->assertCount(1, $stack);
    }

    public function testCheckDataIntoStack()
    {
        $origin      = new Departure($this->faker->city, $this->faker->dateTime(), $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $destination = new Arrival($this->faker->city, $this->faker->dateTime(), $this->faker->lexify('Gate ?'));
        $train       = new Train($this->faker->bothify('??###'));

        $bpass = new Pass($origin, $destination, $train);

        $stack = new Stack();
        $stack->push($bpass);

        $this->assertCount(1, $stack);
        $stack->rewind();
        $this->assertEquals($bpass, $stack->current());
    }
}
