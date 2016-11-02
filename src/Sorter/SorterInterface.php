<?php

namespace BoardingPassSorter\Sorter;

use BoardingPassSorter\Pass\Stack;

/**
 * Interface SorterInterface.
 */
interface SorterInterface
{
    public function sort(Stack $stack, Stack $sortedStack = null) : Stack;
}
