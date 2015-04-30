<?php

namespace spec\MoonSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MoonSpec\MathLibrary;
use MoonSpec\Sun;
use MoonSpec\Epoch;

class MoonSpec extends ObjectBehavior
{

    function it_is_initializable(Epoch $epoch, Sun $sun, MathLibrary $mathLibrary)
    {
        $this->beConstructedWith($epoch, $sun, $mathLibrary);

        $this->shouldHaveType('MoonSpec\Moon');
    }

    function it_returns_phase(Epoch $epoch, Sun $sun, MathLibrary $mathLibrary)
    {
        $epoch->getTimeStampBasedOnEpoch()->willReturn(100000000)->shouldBeCalledTimes(1);
        $sun->getSubGeocentricEclipticLongitudeForEpoch($epoch)->willReturn(10)->shouldBeCalledTimes(1);
        $sun->getMForEpoch($epoch)->willReturn(100)->shouldBeCalledTimes(1);
        $this->beConstructedWith($epoch, $sun, $mathLibrary);

        $this->getPhase()->shouldMatchFloat(0.0091445514427764);
    }

    function it_returns_the_phase_in_the_month(Epoch $epoch, Sun $sun, MathLibrary $mathLibrary)
    {
        $epoch->getTimeStampBasedOnEpoch()->willReturn(100000000)->shouldBeCalledTimes(1);
        $sun->getSubGeocentricEclipticLongitudeForEpoch($epoch)->willReturn(10)->shouldBeCalledTimes(1);
        $sun->getMForEpoch($epoch)->willReturn(100)->shouldBeCalledTimes(1);
        $this->beConstructedWith($epoch, $sun, $mathLibrary);

        $this->getCurrentMoonPhase()->shouldReturn(0.0);
    }

    public function getMatchers()
    {
        return [
            'matchFloat' => function ($float1, $float2) {
                return (abs($float1-$float2) > abs(($float1-$float2)/$float2));
            }
        ];
    }
}
