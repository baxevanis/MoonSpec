<?php

namespace spec\MoonSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MoonSpec\Moon');
    }
}
