<?php

namespace BoardingPassSorter\Vehicle;

use ValueObjects\StringLiteral\StringLiteral;

/**
 * Interface VehicleInterface.
 */
interface VehicleInterface
{
    /**
     * @return bool
     */
    public function hasIdentifier() : bool;

    /**
     * @return StringLiteral
     */
    public function getIdentifier() : StringLiteral;

    /**
     * @return string
     */
    public function __toString() : string;
}
