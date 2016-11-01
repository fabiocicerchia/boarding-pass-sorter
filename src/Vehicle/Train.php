<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class Train
 * @package BoardingPassSorter\Vehicle
 */
class Train extends AbstractVehicle
{
    /**
     * @return string
     */
    public function getVehicleName()
    {
        return 'train';
    }
}
