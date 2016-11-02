<?php

namespace BoardingPassSorter\Describer;

use BoardingPassSorter\Describer\Vehicle;
use BoardingPassSorter\Vehicle\Airplane;

/**
 * Class Pass.
 */
class Pass
{
    protected $pass;

    public function __construct(\BoardingPassSorter\Pass $pass)
    {
        $this->pass = $pass;
    }

    protected function describeFlight()
    {
        return trim(sprintf(
            'Dall\'aeroporto di %s, prendere il volo %s per %s. Imbarco %s, posto %s. %s.',
            $this->pass->getOrigin(),
            new Vehicle($this->pass->getVehicle()),
            $this->pass->getDestination(),
            $this->pass->getOrigin()->getLocation(),
            $this->pass->getSeat(),
            implode('. ', $this->pass->getDetails())
        ));
    }

    protected function describeGeneric()
    {
        $seat = ($this->pass->hasSeat() ? 'Posto assegnato ' . $this->pass->getSeat() : 'Nessuna assegnazione del posto');

        return trim(sprintf(
            '%s da %s a %s. %s. %s',
            new Vehicle($this->pass->getVehicle()),
            $this->pass->getOrigin(),
            $this->pass->getDestination(),
            $seat,
            implode('. ', $this->pass->getDetails())
        ));
    }

    public function __toString() : string
    {
        if ($this->pass->getVehicle() instanceof Airplane) {
            return $this->describeFlight();
        }

        return $this->describeGeneric();
    }
}
