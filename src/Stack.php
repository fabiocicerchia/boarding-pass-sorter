<?php

namespace BoardingPassSorter;

use BoardingPassSorter\Pass\PassInterface;

/**
 * Class Stack
 * @package BoardingPassSorter
 */
class Stack extends \SplStack
{

    /**
     * @param array $details A list of boarding pass
     */
    public function __construct(array $boardingPasses = [])
    {
        foreach ($boardingPasses as $pass) {
            $this->push($pass);
        }
    }

    /**
     * @param PassInterface $boardingPass The pass to be added
     */
    public function push(PassInterface $boardingPass)
    {
        parent::push($boardingPass);

        return $this;
    }
}
