<?php

#date(format, timestamp) // timestamp is optional

/*
    d = days ( 1 to 31 )
    D = Week ( sun to mon )
    m = Month in number ( 1 to 12)
    M = Month in text ( jan to dec)
    y = year (08 or 20)
    Y = year (2008 or 2020)
*/
echo date("d-m-y")."<hr>";
echo date("D-M-Y")."<hr>";

/*
    h = hours ( 1 to 12 )
    H = hours ( 0 to 23 )
    i = minutes ( 0 to 59 )
    s = seconds ( 0 to 59 )
    a = (am or pm)
    A = (AM or PM)
*/
echo date("d-m-y h:i:s a")."<hr>";

#Time in mili seconds
echo time()."<hr>";
//$time = time() + 8000; //if you need to increase time
//echo date("d-m-y h:i:s a", $time)."<hr>";

#getdata()
$dateArr = getdate();
var_dump($dateArr);
echo "<hr>";
//foreach($dateArr as $y => $x)
//    echo $y."=>".$x."<br>";
// echo "weekday = ".getdate()["weekday"]; //we can also use short notation for specific value

#create date
echo date_create("now")->format("y-m-d H:i:s");
echo "<hr>";
//echo date_create("-1 day")->format("y-m-d H:i:s");
//echo "<hr>";
//echo date_create("+1 day")->format("y-m-d H:i:s");

#String to  time
//$strTime = strtotime("2020-05-20 10:09:10");
//echo date("d-m-Y H:i:s", $strTime);
//echo "<hr>";
//if(time() >= $strTime){
//    echo "Time is ahead";
//}else{
//    echo "Time is not ahead";
//}

#Timezone
//echo date_default_timezone_get();
//echo date("d-m-Y h:i:s")."<br>";

//date_default_timezone_set("Australia/Melbourne"); //set time zone and
//echo date("m/d/y h:i:s a");                        //echo date time
//echo date_default_timezone_get();                   //check time zone

#diffrence between date and time
//$start = date_create("2020-05-20 10:09:10");
//$end = date_create("2020-05-20 11:10:20");
//$diff = date_diff($start, $end);
//print_r($diff);