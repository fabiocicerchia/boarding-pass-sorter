<?php

namespace BoardingPassSorter\Describer;

use BoardingPassSorter\Describer\Pass as PassDescriber;
use BoardingPassSorter\Route as JourneyRoute;

/**
 * Class Route.
 */
class Route
{
    /**
     * @var JourneyRoute
     */
    protected $route;

    /**
     * @param JourneyRoute $route The route to be described
     */
    public function __construct(JourneyRoute $route)
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {        
        $legs = [];
        foreach ($this->route->getLegs() as $leg) {
            array_unshift($legs, new PassDescriber($leg));
        }

        return implode(PHP_EOL, $legs);
    }
}
