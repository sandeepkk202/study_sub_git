<?php

// Interface for vehicles
interface Vehicle {
    public function drive();
}

// Car class implementing the Vehicle interface
class Car implements Vehicle {
    public function drive() {
        echo "Driving a car.\n";
    }
}

// Bicycle class implementing the Vehicle interface
class Bicycle implements Vehicle {
    public function drive() {
        echo "Riding a bicycle.\n";
    }
}

// Factory class for creating vehicles
class VehicleFactory {
    // Method to create different types of vehicles
    public static function createVehicle($type) {
        switch ($type) {
            case 'car':
                return new Car();
            case 'bicycle':
                return new Bicycle();
            default:
                throw new InvalidArgumentException("Invalid vehicle type.");
        }
    }
}

// Client code
$car = VehicleFactory::createVehicle('car');
$car->drive();  // Output: Driving a car.

$bicycle = VehicleFactory::createVehicle('bicycle');
$bicycle->drive();  // Output: Riding a bicycle.
