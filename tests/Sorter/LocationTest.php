<?php

namespace BoardingPassSorter\Sorter;

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

class LocationTest extends \PHPUnit_Framework_TestCase
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

    protected function getRandomBoardingPass($originCity, $destinationCity)
    {
        $origin      = new Departure($this->getRandomAddress($originCity), DateTime::fromNativeDateTime(new \DateTime('2016-01-01 15:00:00')), DateTime::fromNativeDateTime(new \DateTime('2016-01-01 10:00:00')), new StringLiteral($this->faker->lexify('Gate ?')));
        $destination = new Arrival($this->getRandomAddress($destinationCity), DateTime::fromNativeDateTime(new \DateTime('2016-02-01')), new StringLiteral($this->faker->lexify('Gate ?')));
        $train       = new Train(new StringLiteral($this->faker->bothify('??###')));

        $bpass = new Pass($origin, $destination, $train);

        return $bpass;
    }

    public function testSortingWithOneElement()
    {
        $bpass = $this->getRandomBoardingPass('Rome', 'Milan');
        $list = [$bpass];
        shuffle($list);
        
        $stack = new Stack;
        foreach($list as $item) {
            $stack->push($item);
        }

        $sorter = new Location;
        $sortedStack = $sorter->sort($stack);

        // there shouldn't really need to check if it's sorted
        $this->assertCount(1, $sortedStack);
    }

    public function testSortingWithTwoElement()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');

        $list = [$bpass1, $bpass2];
        shuffle($list);
        
        $stack = new Stack;
        foreach($list as $item) {
            $stack->push($item);
        }

        $sorter = new Location;
        $sortedStack = $sorter->sort($stack);

        $this->assertCount(2, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack->offsetGet(1));
        $this->assertEquals($bpass2, $sortedStack->offsetGet(0));
    }

    public function testSortingWithThreeElement()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');
        $bpass3 = $this->getRandomBoardingPass('Turin', 'Venice');

        $list = [$bpass1, $bpass2, $bpass3];
        shuffle($list);
        
        $stack = new Stack;
        foreach($list as $item) {
            $stack->push($item);
        }

        $sorter = new Location;
        $sortedStack = $sorter->sort($stack);

        $this->assertCount(3, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack->offsetGet(2));
        $this->assertEquals($bpass2, $sortedStack->offsetGet(1));
        $this->assertEquals($bpass3, $sortedStack->offsetGet(0));
    }

    public function testSortingWithFourElement()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');
        $bpass3 = $this->getRandomBoardingPass('Turin', 'Venice');
        $bpass4 = $this->getRandomBoardingPass('Venice', 'New York');

        $list = [$bpass1, $bpass2, $bpass3, $bpass4];
        shuffle($list);
        
        $stack = new Stack;
        foreach($list as $item) {
            $stack->push($item);
        }

        $sorter = new Location;
        $sortedStack = $sorter->sort($stack);

        $this->assertCount(4, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack->offsetGet(3));
        $this->assertEquals($bpass2, $sortedStack->offsetGet(2));
        $this->assertEquals($bpass3, $sortedStack->offsetGet(1));
        $this->assertEquals($bpass4, $sortedStack->offsetGet(0));
    }

    public function testBugWhenSortingFourElements()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');
        $bpass3 = $this->getRandomBoardingPass('Turin', 'Venice');
        $bpass4 = $this->getRandomBoardingPass('Venice', 'New York');

        $list = [$bpass4, $bpass2, $bpass1, $bpass3];
        
        $stack = new Stack;
        foreach($list as $item) {
            $stack->push($item);
        }

        $sorter = new Location;
        $sortedStack = $sorter->sort($stack);

        $this->assertCount(4, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack->offsetGet(3));
        $this->assertEquals($bpass2, $sortedStack->offsetGet(2));
        $this->assertEquals($bpass3, $sortedStack->offsetGet(1));
        $this->assertEquals($bpass4, $sortedStack->offsetGet(0));
    }

    public function testBugWhenSortingTenElements()
    {
        $bpass1 = $this->getRandomBoardingPass('Rome', 'Milan');
        $bpass2 = $this->getRandomBoardingPass('Milan', 'Turin');
        $bpass3 = $this->getRandomBoardingPass('Turin', 'Venice');
        $bpass4 = $this->getRandomBoardingPass('Venice', 'New York');
        $bpass5 = $this->getRandomBoardingPass('New York', 'London');
        $bpass6 = $this->getRandomBoardingPass('London', 'Dublin');
        $bpass7 = $this->getRandomBoardingPass('Dublin', 'Madrid');
        $bpass8 = $this->getRandomBoardingPass('Madrid', 'Lisbon');
        $bpass9 = $this->getRandomBoardingPass('Lisbon', 'Sydney');
        $bpass10 = $this->getRandomBoardingPass('Sydney', 'Naples');

        $list = [$bpass4, $bpass2, $bpass1, $bpass3, $bpass5, $bpass6, $bpass7, $bpass8, $bpass9, $bpass10];
        
        $stack = new Stack;
        foreach($list as $item) {
            $stack->push($item);
        }

        $sorter = new Location;
        $sortedStack = $sorter->sort($stack);

        $this->assertCount(10, $sortedStack);
        $this->assertEquals($bpass1, $sortedStack->offsetGet(9));
        $this->assertEquals($bpass2, $sortedStack->offsetGet(8));
        $this->assertEquals($bpass3, $sortedStack->offsetGet(7));
        $this->assertEquals($bpass4, $sortedStack->offsetGet(6));
        $this->assertEquals($bpass5, $sortedStack->offsetGet(5));
        $this->assertEquals($bpass6, $sortedStack->offsetGet(4));
        $this->assertEquals($bpass7, $sortedStack->offsetGet(3));
        $this->assertEquals($bpass8, $sortedStack->offsetGet(2));
        $this->assertEquals($bpass9, $sortedStack->offsetGet(1));
        $this->assertEquals($bpass10, $sortedStack->offsetGet(0));
    }
}
