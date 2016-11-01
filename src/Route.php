<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Stack;
use BoardingPassSorter\Sorter\SorterInterface;

/**
 * Class Route
 * @package BoardingPassSorter
 */
class Route
{
    protected $legs;

    /**
     * @param array $details A list of boarding pass
     */
    public function __construct(SorterInterface $sorter, Stack $boardingPasses)
    {
        $this->legs = $sorter->sort($boardingPasses->getAll());
    }

    /**
     * @return array
     */
    public function getLegs()
    {
        return $this->legs;
    }

    /**
     * @return BoardingPassSorter\Pass
     */
    public function getStart()
    {
        return reset($this->legs);
    }

    /**
     * @return BoardingPassSorter\Pass
     */
    public function getEnd()
    {
        return end($this->legs);
    }
}
