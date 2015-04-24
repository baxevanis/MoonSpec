<?php

namespace MoonSpec;

use MoonSpec\MathLibrary;

class Sun
{
    const ECLIPTIC_LONGITUDE_EPOCH = 278.833540; // ecliptic longitude of the Sun at epoch 1980.0
    const ECLIPTIC_LONGITUDE_PERIGEE = 282.596403; // ecliptic longitude of the Sun at perigee
    const ECCENTRICITY_OF_EARTH_ORBIT = 0.016718; // eccentricity of Earth's orbit
    const SEMI_MAJOR_AXIS_EARTH_ORBIT_KM = 1.495985e8; // semi-major axis of Earth's orbit, km
    const ANGULAR_SIZE = 0.533128; // sun's angular size, degrees, at semi-major axis distance

    static public function getSubGeocentricEclipticLongitude($day)
    {
        $Ec = MathLibrary::kepler( self::getM($day), self::ECCENTRICITY_OF_EARTH_ORBIT ); // solve equation of Kepler
        $Ec = sqrt( (1 + Sun::ECCENTRICITY_OF_EARTH_ORBIT) / (1 - self::ECCENTRICITY_OF_EARTH_ORBIT) ) * tan( $Ec / 2 );
        $Ec = 2 * rad2deg( atan($Ec) );	// true anomaly
        $Lambdasun = MathLibrary::fixangle( $Ec + self::ECLIPTIC_LONGITUDE_PERIGEE ); // Sun's geocentric ecliptic longitude

        return $Lambdasun;
    }

    static public function getM($day)
    {
        $N = MathLibrary::fixangle( (360 / 365.2422) * $day );	// mean anomaly of the Sun
        $M = MathLibrary::fixangle( $N + self::ECLIPTIC_LONGITUDE_EPOCH - self::ECLIPTIC_LONGITUDE_PERIGEE ); // convert from perigee co-ordinates

        return $M;
    }
}
