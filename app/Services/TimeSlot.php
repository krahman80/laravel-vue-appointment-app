<?php

namespace App\Services;

use DateTime;
use Exception;

class TimeSlot 
{
    private $startDate;
    private $endDate;
    private $interval;

    public function __construct(string $startDate, string $endDate, int $interval)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->interval = $interval;
    }

    public function generate(): array
    {
        $start = new DateTime($this->startDate);
        $end = new DateTime($this->endDate);
        $interval = $this->interval;

        // will be remove if validation is applied
        if ($start >= $end) {
            throw new Exception('start date is bigger then end date.');
        }
        
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $dateFormat = $start->format('Y-m-d');
    
        $i=0;
        $time = [];
        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $startTime = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            
            $i++;
            
            if(strtotime($startTime) <= strtotime($endTime)){
                $time[$i]['date'] = $dateFormat;
                $time[$i]['start_time'] = $start;
                $time[$i]['end_time'] = $end;
            }
        }
        return $time;

    }

}