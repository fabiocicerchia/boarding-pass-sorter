<?php

namespace BoardingPassSorter\Point;

use ValueObjects\DateTime\DateTime;
use ValueObjects\Geography\Address;
use ValueObjects\StringLiteral\StringLiteral;

/**
 * Class AbstractPoint.
 */
abstract class AbstractPoint implements PointInterface
{
    /**
     * @return Address
     */
    protected $place;

    /**
     * @return DateTime
     */
    protected $time;

    /**
     * Platform, gate or binary.
     *
     * @return StringLiteral
     */
    protected $location;

    /**
     * @param Address       $place    The place of the point
     * @param DateTime      $time     The time of the event
     * @param StringLiteral $location The platform, gate or binary
     */
    public function __construct(Address $place, DateTime $time, StringLiteral $location = null)
    {
        $this->place    = $place;
        $this->time     = $time;
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getCity() : string
    {
        return $this->place->getCity();
    }

    /**
     * @return DateTime
     */
    public function getTime() : DateTime
    {
        return $this->time;
    }

    /**
     * @return StringLiteral
     */
    public function getLocation() : StringLiteral
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getCity();
    }
}
