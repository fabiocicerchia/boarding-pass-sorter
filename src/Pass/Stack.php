<?php

namespace BoardingPassSorter\Pass;



/**
 * Class Stack.
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
    public function push($boardingPass) : Stack
    {
        if (!$boardingPass instanceof PassInterface) {
            throw new \InvalidArgumentException('The parameter $boardingPass must be an instance of PassInterface');
        }

        parent::push($boardingPass);

        return $this;
    }
}
