<?php
#'interface' is just like defination/guidelines of the method. it's like contrect 
#'interface' Keyword is used to define interfaces.
#'implements' Keyword is used to implements from interfaces.

# A class can implement multiple interfaces (multiple inheritance).
# Interfaces cannot have properties or concrete methods.
# All methods defined in an interface must be public.

interface car{
    function increaseSpeed();
    function decreaseSpeed();
    function applyBreak();
}
class SportsCar implements car{
    //must have the car functions define here. 
}