<?php
#'interface' is just like defination/guidelines of the method. it's like contrect 
#'interface' Keyword is used to define interfaces.
#'implements' Keyword is used to implements from interfaces.

interface car{
    function increaseSpeed();
    function decreaseSpeed();
    function applyBreak();
}
class SportsCar implements car{
    //must have the car functions define here. 
}