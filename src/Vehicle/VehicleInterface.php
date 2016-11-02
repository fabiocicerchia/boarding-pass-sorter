<?php

namespace BoardingPassSorter\Vehicle;

use ValueObjects\StringLiteral\StringLiteral;

/**
 * Interface VehicleInterface.
 */
interface VehicleInterface
{
    public function getIdentifier() : StringLiteral;
    public function getVehicleName() : string;
}
