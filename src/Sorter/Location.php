<?php

namespace BoardingPassSorter\Sorter;

class Location implements SorterInterface
{
    public function sort(array $stack)
    {
        if (count($stack) === 1) {
            return $stack;
        }

        $departures  = [];
        $arrivals    = [];

        // This loop will split the elements in 2 bucket, based on the fact the
        // first bucket contains passes where the destination is an origin city for another pass,
        // and the second bucket contains passes where the origin city is a destination for another pass.
        foreach ($stack as $itemA) {
            foreach ($stack as $itemB) {
                if ($itemA->getDestination()->getCity() === $itemB->getOrigin()->getCity()) {
                    $departures[] = $itemA;
                    break;
                } elseif ($itemA->getOrigin()->getCity() === $itemB->getDestination()->getCity()) {
                    $arrivals[] = $itemA;
                    break;
                }
            }
        }

        return array_merge($this->sort($departures), $this->sort($arrivals));
    }
}
