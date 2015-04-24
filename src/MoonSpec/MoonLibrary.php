<?php

namespace MoonSpec;

use MoonSpec\Epoch;
use MoonSpec\Sun;
use MoonSpec\Moon;

class MoonLibrary
{

    public function getPhase(\DateTime $dateTime)
    {
        // Phase of the Moon.
        $moonAge = Moon::calculateAge($dateTime);
        $moonPhase = (1 - cos(deg2rad($moonAge))) / 2;
        $monthMoonAge = self::SYNODIC_MONTH * ( MathLibrary::fixangle($moonAge) / 360.0 );


        $return = array ( $moonPhase, $monthMoonAge);

        return $return;

    }

}
