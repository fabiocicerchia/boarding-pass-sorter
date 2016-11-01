<?php

namespace BoardingPassSorter\Stack;

use BoardingPassSorter\Pass\PassInterface;
use BoardingPassSorter\Sorter\SorterInterface;

class Sorted extends \BoardingPassSorter\Stack
{
    /**
     * @param array $details A list of boarding pass
     */
    public function __construct(SorterInterface $sorter, array $boardingPasses = [])
    {
        $this->stack = $sorter->sort($boardingPasses);
    }
}
