<?php
class user{
    private $name;
    
     function __construct(){
        echo "construct is call.<br>";
    }
    
    // that magic method use when some on access/assign private variables     
    function __set($name, $value){
        
        echo "this is set method ($name, $value)<br>";
    }
    
    function __get($name){
        
        echo "this is the get method: ".$name."<br>";
    }
    //if method not exist
    function __call($name, $argu){
        echo "function $name is not avilable.".var_dump($argu);
    }

// __autoload()

//  ----------------------- magic methods ------------------------
// __construct(), __destruct()
// __call(), __callStatic()
// __get(), __set()
// __isset(), __unset()
// __sleep(), __wakeup()
// __serialize(), __unserialize()
// __toString(), __invoke(), __set_state(), __clone(), __debugInfo()
}

$obj = new user();
$obj->emp_name = "sandeep";    
$obj->name;    
$obj->bhago("hello");    
