<?php
# For chaining method you must return $this, like:-
class abc{
    
    function method1(){
        echo "this is method one";
        return $this;
    }
    function method2(){
        echo "this is method two";
    }
        
}

$obj = new abc();
$obj->method1()->method2();