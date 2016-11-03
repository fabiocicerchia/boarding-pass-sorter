<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Describer\Route as RouteDescriber;
use BoardingPassSorter\Pass\Stack;
use BoardingPassSorter\Sorter\Location;

/**
 * Class Api.
 */
class Api
{
    /**
     * @return Stack
     */
    public function createEmptyStack() : Stack
    {
        return new Stack;
    }

    /**
     * @param Stack $stack The stack to be analysed
     *
     * @return Route
     */
    public function getRoute(Stack $stack) : Route
    {
        $sorter = new Location;
        return new Route($sorter, $stack);
    }

    /**
     * @param Route $route The route to be described
     *
     * @return string
     */
    public function describe(Route $route) : string
    {
        return strval(new RouteDescriber($route));
    }
}
