<?php

namespace BoardingPassSorter\Point;

use ValueObjects\Geography\Address;
use ValueObjects\DateTime\DateTime;
use ValueObjects\StringLiteral\StringLiteral;

/**
 * Class Departure.
 */
class Departure extends AbstractPoint
{
    /**
     * @return DateTime
     */
    protected $boarding;

    /**
     * @param Address       $place    The departure place
     * @param DateTime      $time     The departure time
     * @param DateTime      $boarding The boarding time
     * @param StringLiteral $location The departure platform, gate or binary
     */
    public function __construct(Address $place, DateTime $time, DateTime $boarding = null, StringLiteral $location = null)
    {
        if ($boarding !== null && $boarding->toNativeDateTime() > $time->toNativeDateTime()) {
            throw new \InvalidArgumentException('The boarding date cannot be after the departure date');
        }

        parent::__construct($place, $time, $location);

        $this->boarding = $boarding;
    }

    /**
     * @return DateTime
     */
    public function getBoarding() : DateTime
    {
        return $this->boarding;
    }
}
