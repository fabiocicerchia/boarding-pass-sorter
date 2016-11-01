<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Pass\PassInterface;
use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;

class Pass implements PassInterface
{
    /**
     * @var Departure
     */
    protected $origin;

    /**
     * @var Arrival
     */
    protected $destination;

    /**
     * @return string
     */
    protected $seat;

    /**
     * @return array
     */
    protected $details;

    /**
     * @param Departure $origin The journey origin place
     * @param Arrival $destination The journey destination place
     */
    public function __construct(Departure $origin, Arrival $destination, $seat = null, array $details = [])
    {
        $this->origin      = $origin;
        $this->destination = $destination;
        $this->seat        = $seat;
        $this->details     = $details;
    }

    /**
     * @return Departure
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @return Arrival
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @return array
     */
    public function getDetails()
    {
        return $this->details;
    }
}
