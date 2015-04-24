<?php

namespace MoonSpec;

class Epoch
{
    const EPOCH = 2444238.5; // 1980 January 0.0
    const EPOCH_IN_JULIAN = 2440587.5;
    const SECONDS_PER_DAY = 86400;

    protected $wantedDateTime;

    public function __construct(\DateTime $wantedDateTime)
    {
        $this->wantedDateTime = $wantedDateTime;
    }

    public function getWantedDateTime()
    {
        return $this->wantedDateTime;
    }

    public function getTimeStampBasedOnEpoch()
    {
        return (( $this->getWantedDateTime()->getTimestamp() / self::SECONDS_PER_DAY ) - (self::EPOCH - self::EPOCH_IN_JULIAN));
    }

}
