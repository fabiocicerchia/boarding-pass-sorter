<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Pass\PassInterface;

class Stack implements \Countable
{
    /**
     * @var PassInterface[]
     */
    protected $stack = [];

    /**
     * @param array $details A list of boarding pass
     */
    public function __construct(array $boardingPasses = [])
    {
        $this->stack = $boardingPasses;
    }

    public function add(PassInterface $boardingPass)
    {
        array_push($this->stack, $boardingPass);

        return $this;
    }

    /**
     * @return Departure
     */
    public function getAll()
    {
        return $this->stack;
    }

    // COUNTABLE INTERFACE METHODS
    public function count()
    {
        return count($this->stack);
    }
}
