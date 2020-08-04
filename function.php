<?php
declare(strict_types=1);
//Define a function
function even_number($limit){
    for($num=0;$num <= $limit;$num++){
    if($num%2==0)
        echo $num.", ";
}}

// Call a function
even_number("10");

echo "<br><b>Line no.".__LINE__."</b>"."<hr>";

function sum($a, $b){
    return $a + $b;
}

echo sum(23,2);

echo "<br><b>Line no.".__LINE__."</b>"."<hr>";


// Pass type parameter    
function even_number1(int $limit , $skip){
    for($num=0;$num <= $limit;$num++){
        if($num == $skip)
            continue;
    if($num%2==0)
        echo $num.", ";
}}

even_number1(10,"6");

echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
// Optional parameter    
function odd_number2($limit , $skip = -1){
    for($num=0;$num <= $limit;$num++){
        if($num == $skip)
            continue;
    if($num%2 !== 0)
        echo $num.", ";
}}

odd_number2(10);


//------------------------------  Calculator function  --------------------
echo "<br><b>Line no.".__LINE__."</b>"."<hr>";

function calculate(int $x, int $y, $temp = "ok"){
    $sum = $x + $y;
    echo $sum.", ";
$sub = $x - $y;
    echo $sub.", ";
$multiple = $x * $y;
    echo $multiple.", ";
$divide = $x / $y;
    echo $divide;
    
}

calculate(2,5);