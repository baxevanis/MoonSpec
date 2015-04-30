<?php

namespace spec\MoonSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MathLibrarySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MoonSpec\MathLibrary');
    }

    function it_can_fix_angles()
    {
        $this->fixAngle(90)->shouldReturn(90.0);
        $this->fixAngle(-90)->shouldReturn(270.0);
        $this->fixAngle(361)->shouldReturn(1.0);
    }

    function it_can_solve_kepler_equation()
    {
        $ecc = 0.5;
        $m = 90;
        $this->kepler($m, $ecc)->shouldMatchFloat(2.0209799380898);
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
