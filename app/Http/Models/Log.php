<?php

namespace App\Http\Models;

use MongoDB\BSON\UTCDateTime;

class Log extends Moloquent
{
    public function fromDateTime($value)
    {
        $dateTime = parent::fromDateTime($value)->toDateTime();
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        return new UTCDateTime((strtotime($dateTime)+8*60*60)*1000);
    }
}