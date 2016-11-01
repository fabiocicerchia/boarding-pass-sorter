<?php

namespace BoardingPassSorter\Sorter;

/**
 * Class Location
 * @package BoardingPassSorter\Sorter
 */
class Location implements SorterInterface
{
    /**
     * O(n)
     * @param array $sort The stack to be sorted
     */
    public function sort(array $stack, $sorted = [])
    {
        if (count($stack) === 1) {
            return $stack;
        }

        // Push a value to be used as initial reference
        if (empty($sorted)) {
            array_push($sorted, array_shift($stack));
        }

        $unmatched = [];

        foreach($stack as $item) {
            $source      = reset($sorted)->getOrigin()->getCity();
            $destination = end($sorted)->getDestination()->getCity();

            if ($item->getOrigin()->getCity() === $destination || $item->getDestination()->getCity() === $source) {
                // Append it if it's a future journey
                if ($item->getOrigin()->getCity() === $destination) {
                    array_push($sorted, $item);
                }

                // Prepend it if it's a past journey
                if ($item->getDestination()->getCity() === $source) {
                    array_unshift($sorted, $item);
                }
            } else {
                // If it's not either a destination or an origin, push it into the unmatched to be re-checked later on
                array_push($unmatched, $item);
            }
        }

        // Retry the unmatched items
        if (!empty($unmatched)) {
            return $this->sort($unmatched, $sorted);
        }

        return $sorted;
    }
}
