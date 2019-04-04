<?php

use Carbon\Carbon;

$weekMap = [
    0 => 'Sunday',
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
];

$dayOfTheWeek = Carbon::now()->dayOfWeek;

$weekMap = $weekMap[$dayOfTheWeek]; 

$date = Carbon::now()->toDateString();

return [
	'dayOfWeek' => $weekMap,
	'fullDate' => $date,
];