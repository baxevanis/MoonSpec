<?php

namespace spec\MoonSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EpochSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $nowDateTime = new \DateTime();
        $this->beConstructedWith($nowDateTime);
        $this->shouldHaveType('MoonSpec\Epoch');

        $this->getDateTime()->shouldReturn($nowDateTime);
    }

    function it_calculate_julian_dates_for_wanted_date()
    {
        $knownDate = new \DateTime('1980-01-01 00:00:00');
        $this->beConstructedWith($knownDate);
        $this->getTimeStampBasedOnEpoch()->shouldReturn(1.0);
    }

    function it_calculate_julian_dates_for_another_wanted_date()
    {
        $knownDate = new \DateTime('1980-01-10 00:00:00');
        $this->beConstructedWith($knownDate);
        $this->getTimeStampBasedOnEpoch()->shouldReturn(10.0);
    }
}
