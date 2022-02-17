<?php

namespace App\Survey\Traits;

trait TimeConverterTrait
{
    public function getLocalDateTime($dateTime)
    {
        $newTimezone = $this->convertLocalTime($dateTime);
        return $newTimezone->format("M d, Y h:i a");
    }

    public function getLocalDate($dateTime)
    {
        $newTimezone = $this->convertLocalTime($dateTime);
        return $newTimezone->format("M d, Y");
    }

    public function convertLocalTime($dateTime)
    {
        $newTime = new \DateTime(date("Y-m-d H:i:s", strtotime($dateTime)));
        $newTime->setTimezone(new \DateTimeZone('Asia/Yangon'));
        return $newTime;
    }
}
