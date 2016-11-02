<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Pass\PassInterface;
use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Point\Departure;
use BoardingPassSorter\Vehicle\VehicleInterface;
use ValueObjects\StringLiteral\StringLiteral;

/**
 * Class Pass.
 */
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
     * @var VehicleInterface
     */
    protected $vehicle;

    /**
     * @return StringLiteral
     */
    protected $seat;

    /**
     * @return array
     */
    protected $details;

    /**
     * @param Departure        $origin      The journey origin place
     * @param Arrival          $destination The journey destination place
     * @param VehicleInterface $vehicle     The vehicle used to travel
     * @param StringLiteral    $seat        The reserved seat number
     * @param array            $details     The journey details
     */
    public function __construct(Departure $origin, Arrival $destination, VehicleInterface $vehicle, StringLiteral $seat = null, array $details = [])
    {
        if ($origin->getTime()->toNativeDateTime() > $destination->getTime()->toNativeDateTime()) {
            throw new \InvalidArgumentException('The departure date cannot be after the arrival date');
        }
        
        $this->origin      = $origin;
        $this->destination = $destination;
        $this->vehicle     = $vehicle;
        $this->seat        = $seat;
        $this->details     = $details;
    }

    /**
     * @return Departure
     */
    public function getOrigin() : Departure
    {
        return $this->origin;
    }

    /**
     * @return Arrival
     */
    public function getDestination() : Arrival
    {
        return $this->destination;
    }

    /**
     * @return VehicleInterface
     */
    public function getVehicle() : VehicleInterface
    {
        return $this->vehicle;
    }

    /**
     * @return bool
     */
    public function hasSeat() : bool
    {
        return $this->seat !== null;
    }

    /**
     * @return StringLiteral
     */
    public function getSeat() : StringLiteral
    {
        return $this->seat;
    }

    /**
     * @return array
     */
    public function getDetails() : array
    {
        return $this->details;
    }
}
