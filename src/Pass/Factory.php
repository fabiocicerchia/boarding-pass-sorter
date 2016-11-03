<?php

namespace BoardingPassSorter\Pass;

use BoardingPassSorter\Pass as BoardingPass;
use BoardingPassSorter\Point\Arrival;
use BoardingPassSorter\Point\Departure;
use ValueObjects\DateTime\DateTime;
use ValueObjects\Geography\Address;
use ValueObjects\Geography\Street;
use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\StringLiteral\StringLiteral;
use BoardingPassSorter\Vehicle\Factory as VehicleFactory;

class Factory
{
    /**
     * @param array $data All the journey details
     *
     * @return BoardingPass
     */
    public static function createPass(array $data)
    {
        $origin = new Departure(
            new Address(
                new StringLiteral($data['origin']['name']),
                new Street(
                    new StringLiteral($data['origin']['streetName']),
                    new StringLiteral($data['origin']['buildingNumber'])
                ),
                new StringLiteral($data['origin']['state']),
                new StringLiteral($data['origin']['city']),
                new StringLiteral($data['origin']['state']),
                new StringLiteral($data['origin']['postcode']),
                new Country(CountryCode::get($data['origin']['countryCode']))
            ),
            DateTime::fromNativeDateTime(new \DateTime($data['origin']['departure'])),
            DateTime::fromNativeDateTime(new \DateTime($data['origin']['boarding'])),
            new StringLiteral($data['origin']['location'])
        );

        $destination = new Arrival(
            new Address(
                new StringLiteral($data['destination']['name']),
                new Street(
                    new StringLiteral($data['destination']['streetName']),
                    new StringLiteral($data['destination']['buildingNumber'])
                ),
                new StringLiteral($data['destination']['state']),
                new StringLiteral($data['destination']['city']),
                new StringLiteral($data['destination']['state']),
                new StringLiteral($data['destination']['postcode']),
                new Country(CountryCode::get($data['destination']['countryCode']))
            ),
            DateTime::fromNativeDateTime(new \DateTime($data['destination']['arrival'])),
            new StringLiteral($data['destination']['location'])
        );

        $vehicle = VehicleFactory::createVehicle($data['vehicle']['type'], new StringLiteral($data['vehicle']['identifier']));

        return new BoardingPass($origin, $destination, $vehicle, new StringLiteral($data['seat']), $data['details']);
    }
}
