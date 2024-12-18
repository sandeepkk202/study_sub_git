<?php
#many form with same method like:-

# Can be achieved through method overriding (in inheritance) and method overloading (in some languages).
# Allows for code reusability and easy maintenance.

interface animal{    
    function eatFood();
}

class billy implements animal{
    function eatFood(){
        echo "milk";
    }
}

class chita implements animal{
    function eatFood(){
        echo "meat";
    }
}

$billy = new billy();
$billy->eatFood();
echo "<br>";
$chita = new chita();
$chita->eatFood();