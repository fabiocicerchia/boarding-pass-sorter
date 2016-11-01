<?php

namespace BoardingPassSorter\Event;

/**
 * Class Arrival
 * @package BoardingPassSorter\Event
 */
class Arrival
{
    /**
     * @return string
     */
    protected $city;

    /**
     * @return \DateTime
     */
    protected $time;
    
    /**
     * Platform, gate or binary
     * @return string
     */
    protected $location;

    /**
     * @param string    $city     The arrival city
     * @param \DateTime $time     The arrival time
     * @param string    $location The arrival platform, gate or binary
     */
    public function __construct($city, \DateTime $time, $location = null)
    {
        $this->city     = $city;
        $this->time     = $time;
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
}
