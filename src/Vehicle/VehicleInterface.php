<?php

namespace BoardingPassSorter\Vehicle;

use ValueObjects\StringLiteral\StringLiteral;

/**
 * Interface VehicleInterface.
 */
interface VehicleInterface
{
    public function hasIdentifier() : bool;
    public function getIdentifier() : StringLiteral;
    public function __toString() : string;
}
