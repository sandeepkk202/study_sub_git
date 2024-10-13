<?php
# cannot create instance of a abstract class.
#'abstract' Keyword is used to define class or method as abstract.


//abstract class car{
//    abstract function increaseSpeed();
//             function decreaseSpeed();
//             function applyBreak();
//}
//class SportsCar extends car{
//    //must have increaseSpeed() method implemented.
//}

# Abstract classes can have properties and concrete methods.
# A class can inherit from only one abstract class (single inheritance).
# Abstract methods must be implemented by derived classes.

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