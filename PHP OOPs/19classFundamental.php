<?php
# Method Overriding

/* 
    Purpose: The primary purpose of overriding is to modify the existing behavior of a method in 
    a derived class. 

    Characteristics: The method in the subclass must have the same name, return type, and parameters as 
    the method in the parent class. Overriding allows for dynamic polymorphism, enabling the correct
    method to be called based on the object type at runtime. 
*/

class Animal {
    public function makeSound() {
        return "Some generic sound";
    }
}

class Dog extends Animal {

    public $name = 'Dog';

    public function makeSound() {
        return "Bark";
    }
}

$animal = new Dog();
echo $animal->makeSound(); // Output: Bark


# Method Overloading

/*  
    Definition: Method overloading is when we define multiple methods with the same name but
    different parameter lists (different types or number of parameters) within the same class. However, 
    PHP does not support true method overloading as seen in some other languages like Java or C#. 
*/
 
// ----------------------------------------------------

# Traits

/* 
    We can not extend more then one class, for resolve muliple inharitance we use TRAITS. 
    'use' Keyword is used to implements from trait.
*/

trait import{
    function one(){}
    function two(){}
}

class abc{
    use import;

    function callOne()
    {
        $this->one();
    }
}

// ----------------------------------------------------

# Dependency Injection 

/*
    Dependency Injection (DI) is a design pattern in which an object receives other objects that it
    depends on. In PHP, DI is typically implemented through constructors, method injection,
    or property injection. Below is an example of dependency injection using a constructor in PHP.
*/

// ----------------------------------------------------

# Work with Object 

class Posts
{
    public $post;
    function __construct($content)
    {
        $this->post = $content;
    }
}

// 1-Cloning Objects

$post1 = new Posts("This is the First Post!");
$post2 = $post1; // Copy referance
$post3 = clone $post2;

// 2-Serialise Objects

/*
//First Seriable in File
    $post1 = new Posts("This is the First Post!");
    $seriablized = serialize($post1);
    echo $seriablized;
    file_put_contents( "posts.txt" , $seriablized);
    
//Second UnSeriable from File into Objects.
    $seriablized1 = file_get_contents("posts.txt");
    $post2 = unserialize($seriablized1);
    echo $post2->post;
*/

// 3-Comparing Objects

/*
    Compare with idendity       $obj1 === $obj2
    Compare with comparision    $obj1 == $
*/

// 4-Iterating Objects

/*
    foreach($post1 as $key => $value){
        echo $key . ' => ' . $value;
    }
    var_dump($post1);
*/

// ----------------------------------------------------

# AutoLoading and Dynamic Calling

/*
    spl_autoload_register(function ($classname){
        echo "Loading class: $classname" . PHP_EOL;
    require_once "$classname.php";
    });


    $file1 = new Files();
    $file1->hello();

    $db1 = new Database();
    $db1->hello();
*/

// --------------------------------

// perent::__construct("sandeep", 'age')