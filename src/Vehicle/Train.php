<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class Train.
 */
class Train extends AbstractVehicle
{
    /**
     * @return string
     */
    public function __toString() : string
    {
        return 'il treno';
    }
}
