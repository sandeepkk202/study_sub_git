<?php

// Prototype interface
interface Prototype {
    public function clone();
}

// Concrete Prototype: Car
class Car implements Prototype {
    private $brand;

    public function __construct($brand) {
        $this->brand = $brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getBrand() {
        return $this->brand;
    }

    // Clone method to create a new instance of Car
    public function clone() {
        return new Car($this->brand);
    }
}

// Client Code
$originalCar = new Car("Toyota");
$clonedCar = $originalCar->clone();

echo "Original Car Brand: " . $originalCar->getBrand() . "\n"; // Output: Original Car Brand: Toyota
echo "Cloned Car Brand: " . $clonedCar->getBrand() . "\n"; // Output: Cloned Car Brand: Toyota

// Modifying the cloned car
$clonedCar->setBrand("Honda");

echo "Original Car Brand: " . $originalCar->getBrand() . "\n"; // Output: Original Car Brand: Toyota
echo "Cloned Car Brand: " . $clonedCar->getBrand() . "\n"; // Output: Cloned Car Brand: Honda
