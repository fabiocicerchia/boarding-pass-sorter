<?php

namespace BoardingPassSorter\Event;

class Departure
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
     * @return \DateTime
     */
    protected $boarding;
    
    /**
     * Platform, gate or binary
     * @return string
     */
    protected $location;

    public function __construct($city, \DateTime $time, \DateTime $boarding = null, $location = null)
    {
        $this->city     = $city;
        $this->time     = $time;
        $this->boarding = $boarding;
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

    public function getBoarding()
    {
        return $this->boarding;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
