<?php

// Example of serviceContainer

interface Coffee{
    public function serve();
}

class BlackCoffee implements Coffee
{
    public function serve(){
        return "Black Coffee!";
    }
}

class Cappuccino implements Coffee
{
    public function serve(){
        return "Cappuccino Coffee!";
    }
}

class Latte implements Coffee
{
    public function serve(){
        return "Latte Coffee!";
    }
}

// -------------------------------

class CoffeShop
{
    protected array $recipes = [];

    public function register($coffeeName, callable $make)
    {
        $this->recipes[$coffeeName] = $make;
    }

    public function serve($coffeeName)
    {
        if(!isset($this->recipes[$coffeeName])){
            return "Sorry not available!";
        }

        $coffee = call_user_func($this->recipes[$coffeeName]);
        return $coffee->serve();
    }
}


$coffeeShop = new CoffeeShop();

$coffeeShop->register("BlackCoffee", function(){ return new BlackCoffee(); });
$coffeeShop->register("Cappuccino", function(){ return new Cappuccino(); });
$coffeeShop->register("Latte", function(){ return new Latte(); });

// laravel have own container::class like we create CoffeeShop::class,
// That is how we bind the class in laravel service container.
// app()->bind( Latte::class, function(){ return new Latte(); } ); 
// app()->make( Latte::class )->serve('Latte');  //  OUTPUT -> Cappuccino Latte!


echo $coffeeShop->serve('BlackCoffee'); //  OUTPUT -> Black Coffee!
echo $coffeeShop->serve('Cappuccino');  //  OUTPUT -> Cappuccino Coffee!
echo $coffeeShop->serve('Latte');       //  OUTPUT -> Cappuccino Latte!
echo $coffeeShop->serve('Other');       //  OUTPUT -> Sorry not available!