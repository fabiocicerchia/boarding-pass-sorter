<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Pass as BoardingPass;
use BoardingPassSorter\Pass\Stack;
use BoardingPassSorter\Sorter\SorterInterface;

/**
 * Class Route.
 */
class Route
{
    /**
     * @var Stack
     */
    protected $legs;

    /**
     * @param SorterInterface $sorter         The sorting algorithm
     * @param Stack           $boardingPasses A list of boarding pass
     */
    public function __construct(SorterInterface $sorter, Stack $boardingPasses)
    {
        $this->legs = $sorter->sort($boardingPasses);
    }

    /**
     * @return Stack
     */
    public function getLegs() : Stack
    {
        return $this->legs;
    }

    /**
     * @return BoardingPass
     */
    public function getStart() : BoardingPass
    {
        return $this->legs->bottom();
    }

    /**
     * @return BoardingPass
     */
    public function getEnd() : BoardingPass
    {
        return $this->legs->top();
    }
}
