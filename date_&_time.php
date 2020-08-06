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
