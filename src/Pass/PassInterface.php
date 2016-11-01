<?php

namespace BoardingPassSorter\Pass;

use BoardingPassSorter\Pass\PassInterface;
use BoardingPassSorter\Event\Departure;
use BoardingPassSorter\Event\Arrival;

interface PassInterface
{
    /**
     * @return Departure
     */
    public function getOrigin();

    /**
     * @return Arrival
     */
    public function getDestination();

    /**
     * @return string
     */
    public function getSeat();

    /**
     * @return array
     */
    public function getDetails();
}
