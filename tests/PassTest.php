<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;

class PassTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateSimpleBoardingPass()
    {
        $origin      = new Departure('Point A', new \DateTime('2016-01-01 13:00:00'), new \DateTime('2016-01-01 12:40:00'), 'Gate A');
        $destination = new Arrival('Point B', new \DateTime('2016-01-02'), 'Gate B');

        $bpass = new Pass($origin, $destination);

        $this->assertSame('Point A', $bpass->getOrigin()->getCity());
        $this->assertSame('2016-01-01 13:00', $bpass->getOrigin()->getTime()->format('Y-m-d H:i'));
        $this->assertSame('2016-01-01 12:40', $bpass->getOrigin()->getBoarding()->format('Y-m-d H:i'));
        $this->assertSame('Gate A', $bpass->getOrigin()->getLocation());

        $this->assertSame('Point B', $bpass->getDestination()->getCity());
        $this->assertSame('2016-01-02', $bpass->getDestination()->getTime()->format('Y-m-d'));
        $this->assertSame('Gate B', $bpass->getDestination()->getLocation());
    }

    public function testCreateBoardingPassWithSeat()
    {
        $origin      = new Departure('Point A', new \DateTime('2016-01-01'));
        $destination = new Arrival('Point B', new \DateTime('2016-01-02'));

        $bpass = new Pass(
            $origin,
            $destination,
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

        $bpass = new Pass(
            $origin,
            $destination,
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
