<?php

namespace BoardingPassSorter\Point;

use ValueObjects\DateTime\DateTime;
use ValueObjects\StringLiteral\StringLiteral;

/**
 * Interface PointInterface.
 */
interface PointInterface
{
    public function getCity() : string;
    public function getTime() : DateTime;
    public function getLocation() : StringLiteral;
}
