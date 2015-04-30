<?php

namespace MoonSpec;

use MoonSpec\MathLibrary;
use MoonSpec\Sun;

class Moon
{
    const EPOCH_MEAN_LONGITUDE = 64.975464; // moon's mean longitude at the epoch
    const EPOCH_MEAN_LONGITUDE_PERIGEE = 349.383063; // mean longitude of the perigee at the epoch
    const EPOCH_MEAN_LONGITUDE_NODE = 151.950429; // mean longitude of the node at the epoch
    const ORBIT_INCLINATION = 5.145396; // inclination of the Moon's orbit
    const ORBIT_ECCENTRICITY = 0.054900; // eccentricity of the Moon's orbit
    const ANGULAR_SIZE_FROM_EARTH = 0.5181; // moon's angular size at distance a from Earth
    const SEMI_MAJOR_AXIS_ORBIT_IN_KM = 384401.0; // semi-major axis of Moon's orbit in km
    const PARALLAX_DISTANCE_FROM_EARTH = 0.9507; // parallax at distance a from Earth
    const SYNODIC_MONTH = 29.53058868; // synodic month (new Moon to new Moon)

    private $epoch;
    private $sun;
    private $mathLibrary;

    public function __construct(Epoch $epoch = null, Sun $sun = null, MathLibrary $mathLibrary = null) {
        $this->epoch = ($epoch) ?: new Epoch();
        $this->mathLibrary = ($mathLibrary) ?: new MathLibrary();
        $this->sun = ($sun) ?: new Sun($this->mathLibrary);
    }

    private function calculateAgeInDegree()
    {

        $timestampWithinEpoch = $this->epoch->getTimeStampBasedOnEpoch();
        $Lambdasun = $this->sun->getSubGeocentricEclipticLongitudeForEpoch($this->epoch);
        $M = $this->sun->getMForEpoch($this->epoch);

        // Moon's mean longitude.
        $ml = $this->mathLibrary->fixAngle( 13.1763966 * $timestampWithinEpoch + self::EPOCH_MEAN_LONGITUDE );

        // Moon's mean anomaly.
        $MM = $this->mathLibrary->fixAngle( $ml - 0.1114041 * $timestampWithinEpoch - self::EPOCH_MEAN_LONGITUDE_PERIGEE );

        // Evection.
        $Ev = 1.2739 * sin( deg2rad(2 * ($ml - $Lambdasun) - $MM) );

        // Annual equation.
        $Ae = 0.1858 * sin( deg2rad($M) );

        // Correction term.
        $A3 = 0.37 * sin( deg2rad($M) );

        // Corrected anomaly.
        $MmP = $MM + $Ev - $Ae - $A3;

        // Correction for the equation of the centre.
        $mEc = 6.2886 * sin( deg2rad($MmP) );

        // Another correction term.
        $A4 = 0.214 * sin( deg2rad(2 * $MmP) );

        // Corrected longitude.
        $lP = $ml + $Ev + $mEc - $Ae + $A4;

        // Variation.
        $V = 0.6583 * sin( deg2rad(2 * ($lP - $Lambdasun)) );

        // True longitude.
        $lPP = $lP + $V;

        $MoonAgeInDegree = $lPP - $Lambdasun;

        return $MoonAgeInDegree;
    }

    public function getPhase()
    {
        return (1 - cos(deg2rad($this->calculateAgeInDegree()))) / 2;
    }

    public function getCurrentMoonPhase()
    {
        return self::SYNODIC_MONTH * ( $this->mathLibrary->fixAngle($this->calculateAgeInDegree()) / 360.0 );
    }

}
