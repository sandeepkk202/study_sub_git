<?php
#cannot create instance of a abstract class.
#'abstract' Keyword is used to define class or method as abstract.


//abstract class car{
//    abstract function increaseSpeed();
//             function decreaseSpeed();
//             function applyBreak();
//}
//class SportsCar extends car{
//    //must have increaseSpeed() method implemented.
//}

abstract class car{
    abstract function applyBreak();
    
    function hello(){
        echo "this is hello";
                    }
}

class sportsCar extends car{
     function applyBreak(){}
}

$obj = new sportsCar();
$obj->hello();