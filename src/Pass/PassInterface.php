<?php

namespace BoardingPassSorter\Pass;

/**
 * Interface PassInterface
 * @package BoardingPassSorter\Pass
 */
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
