<?php

namespace spec\MoonSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoonSpecSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MoonSpec\MoonSpec');
    }

    function it_is_instatiated_with_today()
    {
        $this->getDateTime()->shouldHaveType('DateTime');
    }

    function it_is_instantiated_with_existing_dateTime()
    {
        $wantedDate = new \DateTime('2000-01-01 10:00:00');
        $this->beConstructedWith($wantedDate);

        $this->getDateTime()->shouldReturn($wantedDate);
    }

    function it_returns_moon_phase()
    {
        $wantedDate = new \DateTime('2000-01-01 10:00:00');
        $this->beConstructedWith($wantedDate);


    }
}
