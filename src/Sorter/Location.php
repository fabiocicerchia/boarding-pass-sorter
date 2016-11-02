<?php

namespace BoardingPassSorter\Sorter;

use BoardingPassSorter\Pass\Stack;

/**
 * Class Location.
 */
class Location implements SorterInterface
{
    /**
     * @param array $sort The stack to be sorted
     *
     * @return Stack
     */
    public function sort(Stack $stack, Stack $sortedStack = null) : Stack
    {
        // Push a value to be used as initial reference
        if ($sortedStack === null) {
            $sortedStack = new Stack();
            $sortedStack->push($stack->shift());
        }

        $unmatched = new Stack();

        foreach ($stack as $item) {
            $source      = $sortedStack->bottom()->getOrigin()->getCity();
            $destination = $sortedStack->top()->getDestination()->getCity();

            if ($item->getOrigin()->getCity() == $destination) {
                // Append it if it's a future journey
                $sortedStack->push($item);
            } elseif ($item->getDestination()->getCity() == $source) {
                // Prepend it if it's a past journey
                $sortedStack->unshift($item);
            } else {
                // If it's not either a destination or an origin, push it into the unmatched to be re-checked later on
                $unmatched->push($item);
            }
        }

        // Retry the unmatched items
        if ($unmatched->count() > 0) {
            return $this->sort($unmatched, $sortedStack);
        }

        return $sortedStack;
    }
}
