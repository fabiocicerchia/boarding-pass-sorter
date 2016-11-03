<?php

namespace BoardingPassSorter\Vehicle;

use ValueObjects\StringLiteral\StringLiteral;

class Factory
{
    const TYPE_AIRPLANE = 'airplane';
    const TYPE_BUS      = 'bus';
    const TYPE_TRAIN    = 'train';

    /**
     * @param string        $type       The vehicle type
     * @param StringLiteral $identifier The vehicle identifier
     *
     * @throws \OutOfRangeException
     *
     * @return BoardingPass
     */
    public static function createVehicle(string $type, StringLiteral $identifier = null)
    {
        if ($type === self::TYPE_AIRPLANE) {
            return new Airplane($identifier);
        } elseif ($type === self::TYPE_BUS) {
            return new Bus($identifier);
        } elseif ($type === self::TYPE_TRAIN) {
            return new Train($identifier);
        }

        throw new \OutOfRangeException('The type "' . $type . '" does not exist.');
    }
}
