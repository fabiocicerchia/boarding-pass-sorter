<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class Bus.
 */
class Bus extends AbstractVehicle
{
    public function __toString() : string
    {
        return 'l\'autobus';
    }
}
