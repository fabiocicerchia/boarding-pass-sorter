<?php

namespace BoardingPassSorter\Describer;

use BoardingPassSorter\Vehicle\Airplane;
use BoardingPassSorter\Vehicle\VehicleInterface;

/**
 * Class Vehicle.
 */
class Vehicle
{
    protected $vehicle;

    public function __construct(VehicleInterface $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    protected function describeFlight()
    {
        return sprintf('%s', $this->vehicle->getIdentifier());
    }

    protected function describeGeneric()
    {
        $description = 'Prendere %s';
        $data = [$this->vehicle];

        if ($this->vehicle->hasIdentifier()) {
            $description .= ' %s';
            $data[] = $this->vehicle->getIdentifier();
        }

        return vsprintf($description, $data);
    }

    public function __toString() : string
    {
        if ($this->vehicle instanceof Airplane) {
            return $this->describeFlight();
        }

        return $this->describeGeneric();
    }
}
