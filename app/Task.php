<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Datetime;
use \DateTimeZone;

class Task extends Model
{
    // THIS IS HOW WE CAN GET USER TIMEZONE ON THE BACKEND BUT IM HOSTING THIS PROJECT ON THE FREE HOSTING THEY DONT ALLOW OUTGOING HTTPS CALLS  //
    // WE CAN ALSO USE CURL TO GET TIMEZONE BASED ON CLIENT API WHICH WE CAN GET FROM $_SERVER SUPER GLOBAL VARIABLE. //
    
    // public function getdeadlineAttribute($value)
    // {
    //     $ip = $_SERVER['REMOTE_ADDR'];
    //     $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
    //     $ipInfo = json_decode($ipInfo);
    //     $user_timezone = $ipInfo->timezone;
    //     $date = new DateTime($value, new DateTimeZone($user_timezone));
    //     return $date->format('Y-m-d H:i:s');
    // }

    // public function setdeadlineAttribute($value)
    // {
    //     // CONVERTING USER TIMEZONE TO UTC TIMEZONE. GETTING TIMEZONE THROUGH JQUERY BECAUSE OF THE FREE SERVER LIMITATION OTHERWISE BACKEND WILL BE MUCH EFFIECNT //
    //     // SAVING THE TIMESTAMP IN THE DATABASE WITHOUT TIMZONE. AS WE HAVE CONFIIGURED UTC UNIVERSAL USAGE FOR TIMESTAMP IN THE SYSTEM AND THEN CONVERT IT BACK TO USER TIMEZONE //
    //     $date = new DateTime($value["deadline"], new DateTimeZone($value["timezone"]));
    //     $date->setTimezone(new DateTimeZone(config('app.timezone')));
    //     $this->attributes['deadline'] =  $date->format('Y-m-d H:i:s');
    // }
}
