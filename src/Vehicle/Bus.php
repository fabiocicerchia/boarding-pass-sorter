<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class Bus.
 */
class Bus extends AbstractVehicle
{
    /**
     * @return string
     */
    public function __toString() : string
    {
        return 'l\'autobus';
    }
}
