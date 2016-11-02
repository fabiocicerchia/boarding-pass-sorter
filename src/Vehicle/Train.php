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
    public function getVehicleName() : string
    {
        return 'train';
    }
}
