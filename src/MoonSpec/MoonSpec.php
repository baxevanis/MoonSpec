<?php

namespace MoonSpec;

class MoonSpec
{
    protected $dateTime;

    public function __construct(\DateTime $dateTime = null)
    {
        if($dateTime === null) {
            $dateTime = new \DateTime();
        }

        $this->dateTime = $dateTime;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }
}
