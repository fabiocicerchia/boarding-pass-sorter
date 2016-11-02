<?php

namespace BoardingPassSorter\Pass;

use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Point\Departure;
use ValueObjects\StringLiteral\StringLiteral;

/**
 * Interface PassInterface.
 */
interface PassInterface
{
    /**
     * @return Departure
     */
    public function getOrigin() : Departure;

    /**
     * @return Arrival
     */
    public function getDestination() : Arrival;

    /**
     * @return StringLiteral
     */
    public function getSeat() : StringLiteral;

    /**
     * @return array
     */
    public function getDetails() : array;
}
