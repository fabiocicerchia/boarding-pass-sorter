<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class Airplane.
 */
class Airplane extends AbstractVehicle
{
    public function __toString() : string
    {
        return 'il volo';
    }
}
