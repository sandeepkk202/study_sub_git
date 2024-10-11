<?php
#if you want accessible method and properties without instance, apply keyword "static". 
#if want access class member inside the class use self:: rether $this. $this keyword use for instance.
class car{
    static $name = "ferrari";
    static $temp;
    static function applyBreak($x){
        echo "appy Breaka";
        self::$temp = $x;
    }
}

car::$name = car::applyBreak(" 2 min");
echo car:: $name;
echo car:: $temp;

