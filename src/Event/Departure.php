<?php

namespace BoardingPassSorter\Event;

/**
 * Class Departure
 * @package BoardingPassSorter\Event
 */
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

    /**
     * @param string    $city     The departure city
     * @param \DateTime $time     The departure time
     * @param \DateTime $time     The boarding time
     * @param string    $location The departure platform, gate or binary
     */
    public function __construct($city, \DateTime $time, \DateTime $boarding = null, $location = null)
    {
        $this->city     = $city;
        $this->time     = $time;
        $this->boarding = $boarding;
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
     * @return \DateTime
     */
    public function getBoarding()
    {
        return $this->boarding;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
}
