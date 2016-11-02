<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class Train.
 */
class Train extends AbstractVehicle
{
    public function __toString() : string
    {
        return 'il treno';
    }
}
