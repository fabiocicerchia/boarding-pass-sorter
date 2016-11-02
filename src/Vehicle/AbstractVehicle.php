<?php

namespace BoardingPassSorter\Vehicle;

use ValueObjects\StringLiteral\StringLiteral;

/**
 * Class AbstractVehicle.
 */
abstract class AbstractVehicle implements VehicleInterface
{
    /**
     * @var StringLiteral
     */
    protected $identifier;

    /**
     * @param StringLiteral $identifier The vehicle identification number
     */
    public function __construct(StringLiteral $identifier = null)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return bool
     */
    public function hasIdentifier() : bool
    {
        return $this->identifier !== null;
    }

    /**
     * @return StringLiteral
     */
    public function getIdentifier() : StringLiteral
    {
        return $this->identifier;
    }
}
