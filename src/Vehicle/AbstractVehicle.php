<?php

namespace BoardingPassSorter\Vehicle;

/**
 * Class AbstractVehicle
 * @package BoardingPassSorter\Vehicle
 */
abstract class AbstractVehicle
{
    /**
     * @var string
     */
    protected $identifier;

    /**
     * @param string $identifier The vehicle identification number
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
