<?php

/*
    1. Single Responsibility Principle (SRP)
    A class should have only one reason to change, meaning it should have only one job.
*/

// Bad Example:
class Report {
    public function generate() {
        // Generate the report
    }
    
    public function sendEmail($email) {
        // Code to send the report via email
    }
}

// Refactored (Good) Example:
class ReportGenerator {
    public function generate() {
        // Generate the report
    }
}

class EmailSender {
    public function sendEmail($email, $content) {
        // Send the report via email
    }
}

/*
    2. Open/Closed Principle (OCP)
    Objects or entities should be open for extension but closed for modification.
*/

// Bad Example:
class Discount {
    public function calculate($type, $amount) {
        if ($type === 'percentage') {
            return $amount * 0.10;
        } elseif ($type === 'fixed') {
            return 5;
        }
    }
}

// Refactored (Good) Example:
interface DiscountInterface {
    public function calculate($amount);
}

class PercentageDiscount implements DiscountInterface {
    public function calculate($amount) {
        return $amount * 0.10;
    }
}

class FixedDiscount implements DiscountInterface {
    public function calculate($amount) {
        return 5;
    }
}

class DiscountCalculator {
    public function applyDiscount(DiscountInterface $discount, $amount) {
        return $discount->calculate($amount);
    }
}


/*
    3. Liskov Substitution Principle (LSP)
    Objects of a superclass should be replaceable with objects of a subclass without affecting the correctness of the program.
*/

// Bad Example:
class Rectangle {
    protected $width;
    protected $height;

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getArea() {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle {
    public function setWidth($width) {
        $this->width = $width;
        $this->height = $width;
    }

    public function setHeight($height) {
        $this->width = $height;
        $this->height = $height;
    }
}

// Refactored (Good) Example:
interface Shape {
    public function getArea();
}

class Rectangle implements Shape {
    protected $width;
    protected $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function getArea() {
        return $this->width * $this->height;
    }
}

class Square implements Shape {
    protected $side;

    public function __construct($side) {
        $this->side = $side;
    }

    public function getArea() {
        return $this->side * $this->side;
    }
}



/*
    4. Interface Segregation Principle (ISP)
    A client should not be forced to implement interfaces it does not use.
*/

// Bad Example:
interface WorkerInterface {
    public function work();
    public function sleep();
}

class HumanWorker implements WorkerInterface {
    public function work() {
        // Do human work
    }

    public function sleep() {
        // Humans need sleep
    }
}

class RobotWorker implements WorkerInterface {
    public function work() {
        // Do robot work
    }

    public function sleep() {
        // Robots don't sleep!
    }
}

// Refactored (Good) Example:
interface WorkableInterface {
    public function work();
}

interface SleepableInterface {
    public function sleep();
}

class HumanWorker implements WorkableInterface, SleepableInterface {
    public function work() {
        // Do human work
    }

    public function sleep() {
        // Humans need sleep
    }
}

class RobotWorker implements WorkableInterface {
    public function work() {
        // Do robot work
    }
}


/*
    5. Dependency Inversion Principle (DIP)
    High-level modules should not depend on low-level modules. Both should depend on abstractions.
*/

// Bad Example:
class MySQLConnection {
    public function connect() {
        // Connect to MySQL database
    }
}

class PasswordReminder {
    private $dbConnection;

    public function __construct(MySQLConnection $dbConnection) {
        $this->dbConnection = $dbConnection;
    }
}

// Refactored (Good) Example:
interface DBConnectionInterface {
    public function connect();
}

class MySQLConnection implements DBConnectionInterface {
    public function connect() {
        // Connect to MySQL database
    }
}

class PostgreSQLConnection implements DBConnectionInterface {
    public function connect() {
        // Connect to PostgreSQL database
    }
}

class PasswordReminder {
    private $dbConnection;

    public function __construct(DBConnectionInterface $dbConnection) {
        $this->dbConnection = $dbConnection;
    }
}
