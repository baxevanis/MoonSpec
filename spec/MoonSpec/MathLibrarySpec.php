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
}
