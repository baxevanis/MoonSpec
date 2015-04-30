<?php

namespace spec\MoonSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MoonSpec\Epoch;
use MoonSpec\MathLibrary;

class SunSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MoonSpec\Sun');
    }

    function it_can_calculate_m(Epoch $epoch, MathLibrary $mathLibrary)
    {
        $epoch->getTimeStampBasedOnEpoch()->willReturn(100000000000000)->shouldBeCalledTimes(1);
        $mathLibrary->fixAngle(Argument::type('double'))->willReturn(100)->shouldBeCalledTimes(2);

        $this->beConstructedWith($mathLibrary);

        $this->getMForEpoch($epoch)->shouldReturn(100);
    }

    function it_can_calculate_its_subgeocentric_ecliptic_longitude(Epoch $epoch, MathLibrary $mathLibrary)
    {
        $epoch->getTimeStampBasedOnEpoch()->willReturn(100000000000000)->shouldBeCalledTimes(1);
        $mathLibrary->fixAngle(Argument::type('double'))->willReturn(100)->shouldBeCalledTimes(3);
        $mathLibrary->kepler(100, Argument::any())->willReturn(121)->shouldBeCalledTimes(1);

        $this->beConstructedWith($mathLibrary);

        $this->getSubGeocentricEclipticLongitudeForEpoch($epoch)->shouldReturn(100);
    }

}
