<?php

namespace BoardingPassSorter\Describer;

use BoardingPassSorter\Describer\Vehicle as VehicleDescriber;
use BoardingPassSorter\Pass as BoardingPass;
use BoardingPassSorter\Vehicle\Airplane;

/**
 * Class Pass.
 */
class Pass
{
    /**
     * @var BoardingPass
     */
    protected $boardingPass;

    /**
     * @param BoardingPass $boardingPass The pass to be described
     */
    public function __construct(BoardingPass $boardingPass)
    {
        $this->boardingPass = $boardingPass;
    }

    /**
     * Describe specifically a Flight Pass.
     *
     * @return string
     */
    protected function describeFlight()
    {
        $message = 'Dall\'aeroporto di %s, prendere il volo %s per %s. Imbarco %s, posto %s. %s.';
        return trim(sprintf(
            $message,
            $this->boardingPass->getOrigin(),
            new VehicleDescriber($this->boardingPass->getVehicle()),
            $this->boardingPass->getDestination(),
            $this->boardingPass->getOrigin()->getLocation(),
            $this->boardingPass->getSeat(),
            implode('. ', $this->boardingPass->getDetails())
        ));
    }

    /**
     * Describe generically any Pass.
     *
     * @return string
     */
    protected function describeGeneric()
    {
        $seat = $this->boardingPass->hasSeat()
                ? 'Posto assegnato ' . $this->boardingPass->getSeat()
                : 'Nessuna assegnazione del posto';

        $message = '%s da %s a %s. %s. %s';
        return trim(sprintf(
            $message,
            new VehicleDescriber($this->boardingPass->getVehicle()),
            $this->boardingPass->getOrigin(),
            $this->boardingPass->getDestination(),
            $seat,
            implode('. ', $this->boardingPass->getDetails())
        ));
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        if ($this->boardingPass->getVehicle() instanceof Airplane) {
            return $this->describeFlight();
        }

        return $this->describeGeneric();
    }
}
