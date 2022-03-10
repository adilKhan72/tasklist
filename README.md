## Test Project for demo by Adil Khan

## Quick Installation for local

    git clone https://github.com/adilKhan72/tasklist.git quickstart

    cd quickstart

    composer install

    php artisan migrate

    php artisan serve

## This project is live on a free hosting (AWARDSPACE.COM) 

URL http://tasklisttesting.scienceontheweb.net/quickstart/public/

## OTHER DETAILS ABOUT THE PROJECT
 
This Project is made by adil khan in laravel 5 

## why choose laravel 5 

    - because of the limitation of free hosting server im using
    - free server dont allow some php functions to be used 

## Important Note

    - In this project the datetime timezone of user is basically getting from the front end side and not from the backend side 
      because the free server dont allow user for outgoing https or http or ftp or sftp calls

## SEE THE BELOW PICTURES FOR SERVER LIMITATIONS

In the root directory
    SERVER_LIMITATION.JPG

## EXAMPLE FOR GETTING AND CONVERTING TIME ZONE ON THE BACKEND

## E.G 1 : by file_get_contents

$ip = $_SERVER['REMOTE_ADDR']
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
echo date_default_timezone_get();
echo date('Y/m/d H:i:s');

## E.G 1 : by curl

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $your_url);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
$ipInfo = curl_exec($ch);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
curl_close($ch);
$date_with_user_timezone = new DateTime($_POST["deadline"], new DateTimeZone($timezone));
