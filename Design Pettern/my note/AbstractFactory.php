<?php

// Abstract Product A
interface Chair {
    public function sitOn();
}

// Concrete Product A1
class VictorianChair implements Chair {
    public function sitOn() {
        echo "Sitting on a Victorian Chair.\n";
    }
}

// Concrete Product A2
class ModernChair implements Chair {
    public function sitOn() {
        echo "Sitting on a Modern Chair.\n";
    }
}

// Abstract Product B
interface Sofa {
    public function relaxOn();
}

// Concrete Product B1
class VictorianSofa implements Sofa {
    public function relaxOn() {
        echo "Relaxing on a Victorian Sofa.\n";
    }
}

// Concrete Product B2
class ModernSofa implements Sofa {
    public function relaxOn() {
        echo "Relaxing on a Modern Sofa.\n";
    }
}

// Abstract Factory
interface FurnitureFactory {
    public function createChair(): Chair;
    public function createSofa(): Sofa;
}

// Concrete Factory 1: Victorian Furniture Factory
class VictorianFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair {
        return new VictorianChair();
    }

    public function createSofa(): Sofa {
        return new VictorianSofa();
    }
}

// Concrete Factory 2: Modern Furniture Factory
class ModernFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair {
        return new ModernChair();
    }

    public function createSofa(): Sofa {
        return new ModernSofa();
    }
}

// Client Code
function createFurniture(FurnitureFactory $factory) {
    $chair = $factory->createChair();
    $sofa = $factory->createSofa();

    $chair->sitOn();
    $sofa->relaxOn();
}

// Usage
$modernFactory = new ModernFurnitureFactory();
$victorianFactory = new VictorianFurnitureFactory();

echo "Using Modern Furniture:\n";
createFurniture($modernFactory);

echo "\nUsing Victorian Furniture:\n";
createFurniture($victorianFactory);
