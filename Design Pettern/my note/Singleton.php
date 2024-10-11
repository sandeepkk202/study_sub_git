<?php

class Singleton {
    // Hold the instance of the class
    private static $instance = null;
    
    // Private constructor to prevent instantiation from outside
    private function __construct() {
        // Optional: Initialization code goes here
    }
    
    // Get the instance of the class
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    // Optional: Any other methods of the class go here
    public function doSomething() {
        echo "Singleton instance is doing something.\n";
    }
}

// Usage
$singleton1 = Singleton::getInstance();
$singleton1->doSomething(); // Output: Singleton instance is doing something.

$singleton2 = Singleton::getInstance();
// Both $singleton1 and $singleton2 refer to the same instance
var_dump($singleton1 === $singleton2); // Output: bool(true)
