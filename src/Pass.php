<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Point\Departure;
use BoardingPassSorter\Pass\PassInterface;
use BoardingPassSorter\Vehicle\VehicleInterface;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Structure\Collection;

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
     * @return Collection
     */
    protected $details;

    /**
     * @param Departure        $origin      The journey origin place
     * @param Arrival          $destination The journey destination place
     * @param VehicleInterface $vehicle     The vehicle used to travel
     * @param StringLiteral    $seat        The reserved seat number
     * @param Collection       $details     The journey details
     */
    public function __construct(Departure $origin, Arrival $destination, VehicleInterface $vehicle, StringLiteral $seat = null, Collection $details = null)
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
     * @return StringLiteral
     */
    public function getSeat() : StringLiteral
    {
        return $this->seat;
    }

    /**
     * @return Collection
     */
    public function getDetails() : Collection
    {
        return $this->details;
    }
}
