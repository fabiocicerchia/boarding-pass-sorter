<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Pass\PassInterface;
use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;
use BoardingPassSorter\Vehicle\AbstractVehicle;

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
     * @var AbstractVehicle
     */
    protected $vehicle;

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
     * @param AbstractVehicle $vehicle The vehicle used to travel
     * @param string $seat The reserved seat number
     * @param array $details The journey details
     */
    public function __construct(Departure $origin, Arrival $destination, AbstractVehicle $vehicle, $seat = null, array $details = [])
    {
        $this->origin      = $origin;
        $this->destination = $destination;
        $this->vehicle     = $vehicle;
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
