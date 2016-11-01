<?php

namespace BoardingPassSorter\Event;

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

    public function __construct($city, \DateTime $time, $location = null)
    {
        $this->city     = $city;
        $this->time     = $time;
        $this->location = $location;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
