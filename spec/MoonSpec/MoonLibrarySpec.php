<?php

namespace spec\MoonSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MoonSpec\Moon;

class MoonLibrarySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MoonSpec\MoonLibrary');
    }

    function it_calculates_moon_phase()
    {
        $this->getPhase()->shouldReturn(Moon::FULL_MOON);
    }
}
