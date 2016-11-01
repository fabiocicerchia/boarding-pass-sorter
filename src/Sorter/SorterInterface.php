<?php

namespace BoardingPassSorter\Sorter;

use BoardingPassSorter\Stack;

/**
 * Interface SorterInterface
 * @package BoardingPassSorter\Sorter
 */
interface SorterInterface
{
    public function sort(Stack $stack);
}
