<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoonSpecSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MoonSpec');
    }
}
