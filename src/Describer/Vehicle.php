<?php

namespace BoardingPassSorter\Describer;

use BoardingPassSorter\Vehicle\Airplane;
use BoardingPassSorter\Vehicle\VehicleInterface;

/**
 * Class Vehicle.
 */
class Vehicle
{
    /**
     * @var VehicleInterface
     */
    protected $vehicle;

    /**
     * @param VehicleInterface $vehicle The vehicle to be described
     */
    public function __construct(VehicleInterface $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Describe specifically an Airplane.
     *
     * @return string
     */
    protected function describeAirplane()
    {
        return sprintf('%s', $this->vehicle->getIdentifier());
    }

    /**
     * Describe generically any Vehicle.
     *
     * @return string
     */
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

    /**
     * @return string
     */
    public function __toString() : string
    {
        if ($this->vehicle instanceof Airplane) {
            return $this->describeAirplane();
        }

        return $this->describeGeneric();
    }
}
