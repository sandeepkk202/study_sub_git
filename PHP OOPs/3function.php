<?php
/*
function funName($param, n...){
    
    statement_1;
    statement_2;
    statement_n;

    return returnvalue;
} 
*/

//function printnum($limit){
//    for($x=0;$x<=$limit;$x++)
//        echo $x."<br>";
//}
//printnum(9);

#optional parameters
//function printnum($limit, $anotherLimit = -1){        
//    for($x=0;$x<=$limit;$x++)
//        echo $x."<br>";
//}
//printnum(9);

// function add($a, $b){
//    return $a + $b; 
// }
// function sub($a, $b){
//    return $a - $b; 
// }
// echo add(5, 2);

#retune type array
//function getArray($limit) : array{
//    $arrContainer = [];
//    for($x=0; $x<=$limit; $x++)
//        $arrContainer[] = $x;
//    return $arrContainer;
//}
//$xArray = getArray(5);
//print_r($xArray);

#dynamic function
//$dynmFun = "add";
//$dynmFun = "sub";
//echo $dynmFun(5, 6);

#Lambda/Anonymous function
//$pointVar = function ($a, $b) : int{
//    $x = $a + $b; 
//    return $x; 
//};
//echo $pointVar(5, 3);

#use variable inside function
//$content = "sandeep kumar";
//$pointVar = function () use($content){
//    echo $content;
//};
//$pointVar(); 

#passing reference
//$result = 0;
//function add($a, $b, &$result = null){
//    $result = $a + $b;
//    
//}
//add(6, 9, $result);
//echo $result;

abcFilter([1,2,3,4], function($item){ return ($itme == 3) ? true: false;});

function abcFilter($items, $fn){
      foreach($items as $key => $value) {
        if($fn($value)){
            echo $value;
        }
      }
}