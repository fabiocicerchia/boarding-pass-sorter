<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;
use BoardingPassSorter\Vehicle\Airplane;
use BoardingPassSorter\Vehicle\Bus;
use BoardingPassSorter\Vehicle\Train;

class PassTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateSimpleBoardingPass()
    {
        $origin = new Departure(
            'Point A', // city
            new \DateTime('2016-01-01 13:00:00'), // departure
            new \DateTime('2016-01-01 12:40:00'), // boarding
            'Gate A' // location
        );
        $destination = new Arrival(
            'Point B', // city
            new \DateTime('2016-01-02 10:00:00'), // arrival
            'Gate F' // location);
        );

        $train = new Train('AB123');

        $bpass = new Pass($origin, $destination, $train);

        $this->assertSame('Point A', $bpass->getOrigin()->getCity());
        $this->assertSame('2016-01-01 13:00', $bpass->getOrigin()->getTime()->format('Y-m-d H:i'));
        $this->assertSame('2016-01-01 12:40', $bpass->getOrigin()->getBoarding()->format('Y-m-d H:i'));
        $this->assertSame('Gate A', $bpass->getOrigin()->getLocation());

        $this->assertSame('Point B', $bpass->getDestination()->getCity());
        $this->assertSame('2016-01-02', $bpass->getDestination()->getTime()->format('Y-m-d'));
        $this->assertSame('Gate F', $bpass->getDestination()->getLocation());
    }

    public function testCreateBoardingPassWithSeat()
    {
        $origin      = new Departure('Point A', new \DateTime('2016-01-01'));
        $destination = new Arrival('Point B', new \DateTime('2016-01-02'));

        $airplane = new Airplane('XY0123');

        $bpass = new Pass(
            $origin,
            $destination,
            $airplane,
            'I6'
        );

        $this->assertSame('Point A', $bpass->getOrigin()->getCity());
        $this->assertSame('2016-01-01', $bpass->getOrigin()->getTime()->format('Y-m-d'));

        $this->assertSame('Point B', $bpass->getDestination()->getCity());
        $this->assertSame('2016-01-02', $bpass->getDestination()->getTime()->format('Y-m-d'));

        $this->assertSame('I6', $bpass->getSeat());
    }

    public function testCreateBoardingPassWithSeatAndDetails()
    {
        $origin      = new Departure('Point A', new \DateTime('2016-01-01'));
        $destination = new Arrival('Point B', new \DateTime('2016-01-02'));

        $bus = new Bus('120');

        $bpass = new Pass(
            $origin,
            $destination,
            $bus,
            'I6',
            [
                'note' => 'Possible strike on departure date'
            ]
        );

        $this->assertSame('Point A', $bpass->getOrigin()->getCity());
        $this->assertSame('2016-01-01', $bpass->getOrigin()->getTime()->format('Y-m-d'));

        $this->assertSame('Point B', $bpass->getDestination()->getCity());
        $this->assertSame('2016-01-02', $bpass->getDestination()->getTime()->format('Y-m-d'));

        $this->assertSame('I6', $bpass->getSeat());
        $this->assertCount(1, $bpass->getDetails());
    }
}
