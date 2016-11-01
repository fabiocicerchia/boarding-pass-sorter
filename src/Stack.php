<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Pass\PassInterface;

/**
 * Class Stack
 * @package BoardingPassSorter
 */
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

    /**
     * @param PassInterface $boardingPass The pass to be added
     */
    public function add(PassInterface $boardingPass)
    {
        array_push($this->stack, $boardingPass);

        return $this;
    }

    /**
     * @return PassInterface[]
     */
    public function getAll()
    {
        return $this->stack;
    }

    // COUNTABLE INTERFACE METHODS
    /**
     * @return int
     */
    public function count()
    {
        return count($this->stack);
    }
}
