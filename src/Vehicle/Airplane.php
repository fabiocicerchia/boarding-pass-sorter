<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class Airplane.
 */
class Airplane extends AbstractVehicle
{
    /**
     * @return string
     */
    public function __toString() : string
    {
        return 'il volo';
    }
}
