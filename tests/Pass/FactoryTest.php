<?php

namespace BoardingPassSorter\Pass;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testValidityObject()
    {
        $pass = Factory::createPass([
            'origin'      => [
                'name'           => 'Rome',
                'streetName'     => 'Piazza dei Cinquecento',
                'buildingNumber' => '1',
                'state'          => 'Italy',
                'city'           => 'Rome',
                'state'          => 'Rome',
                'postcode'       => '00100',
                'countryCode'    => 'IT',
                'departure'      => '2016-01-01 11:00:00',
                'boarding'       => '2016-01-01 10:00:00',
                'location'       => 'Binario 1',
            ],
            'destination' => [
                'name'           => 'London',
                'streetName'     => 'Oxford Street',
                'buildingNumber' => '1',
                'state'          => 'UK',
                'city'           => 'London',
                'state'          => 'London',
                'postcode'       => 'W1D',
                'countryCode'    => 'GB',
                'arrival'        => '2016-01-01 13:00:00',
                'location'       => 'Exit 1',
            ],
            'seat'        => '1A',
            'vehicle'     => [
                'type'        => 'airplane',
                'identifier'  => 'FR3005',
            ],
            'details' => [
                'gate' => 'A',
                'note' => 'Possible strike action',
            ],
        ]);
        
        $this->assertInstanceOf('BoardingPassSorter\\Pass', $pass);
        $this->assertInstanceOf('BoardingPassSorter\\Point\\Departure', $pass->getOrigin());
        $this->assertInstanceOf('BoardingPassSorter\\Point\\Arrival', $pass->getDestination());
        $this->assertInstanceOf('BoardingPassSorter\\Vehicle\\Airplane', $pass->getVehicle());
    }
}
