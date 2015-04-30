<?php

namespace MoonSpec;

class Epoch
{
    const EPOCH = 2444238.5; // 1980 January 0.0
    const EPOCH_IN_JULIAN = 2440587.5;
    const SECONDS_PER_DAY = 86400;

    protected $dateTime;

    public function __construct(\DateTime $dateTime = null)
    {
        $this->dateTime = ($dateTime) ?: new \DateTime();
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }

    public function getTimeStampBasedOnEpoch()
    {
        return (( $this->getDateTime()->getTimestamp() / self::SECONDS_PER_DAY ) - (self::EPOCH - self::EPOCH_IN_JULIAN));
    }

}
