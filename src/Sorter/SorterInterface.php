<?php

namespace BoardingPassSorter\Sorter;

use BoardingPassSorter\Pass\Stack;

/**
 * Interface SorterInterface.
 */
interface SorterInterface
{
    /**
     * @param Stack $stack       The stack to be sorted
     * @param Stack $sortedStack The initial sorted stack to be used as base
     *
     * @return Stack
     */
    public function sort(Stack $stack, Stack $sortedStack = null) : Stack;
}
