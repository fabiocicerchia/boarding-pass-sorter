<?php

namespace BoardingPassSorter\Vehicle;

use ValueObjects\StringLiteral\StringLiteral;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testValidityObjectAirplane()
    {
        $vehicle = Factory::createVehicle(Factory::TYPE_AIRPLANE, new StringLiteral('AB123'));
        
        $this->assertInstanceOf('BoardingPassSorter\\Vehicle\\Airplane', $vehicle);
    }
    
    public function testValidityObjectBus()
    {
        $vehicle = Factory::createVehicle(Factory::TYPE_BUS, new StringLiteral('AB123'));
        
        $this->assertInstanceOf('BoardingPassSorter\\Vehicle\\Bus', $vehicle);
    }
    
    public function testValidityObjectTrain()
    {
        $vehicle = Factory::createVehicle(Factory::TYPE_TRAIN, new StringLiteral('AB123'));
        
        $this->assertInstanceOf('BoardingPassSorter\\Vehicle\\Train', $vehicle);
    }
    
    /**
     * @expectedException OutOfRangeException
     * @expectedExceptionMessage The type "boat" does not exist.
     */
    public function testInvalidObject()
    {
        $vehicle = Factory::createVehicle('boat', new StringLiteral('AB123'));
    }
}
