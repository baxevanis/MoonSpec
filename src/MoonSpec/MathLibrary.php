<?php

namespace MoonSpec;

class MathLibrary
{
    static public function fixAngle ( $arg )	{

        return ($arg - 360.0 * (floor($arg / 360.0)));
    }

    static public function kepler ( $m, $ecc ) {
        $EPSILON = 1e-6;
        $m = deg2rad($m);
        $e = $m;

        do  {
            $delta = $e - $ecc * sin( $e ) - $m;
            $e -= $delta / ( 1 - $ecc * cos($e) );
        } while ( abs($delta) > $EPSILON );

        return ( $e );
    }
}
