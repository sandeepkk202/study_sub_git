<?php

### These are principle not Role ###

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
    private DiscountInterface $discount;

    public function __construct(DiscountInterface $discount) {
        $this->discount = $discount;
    }

    public function applyDiscount(float $amount): float {
        return $this->discount->calculate($amount);
    }
}

    $percentageDiscount = new PercentageDiscount();
    $calculator = new DiscountCalculator($percentageDiscount);
    echo $calculator->applyDiscount(1000); // Output: 100

    $fixedDiscount = new FixedDiscount();
    $calculator = new DiscountCalculator($fixedDiscount);
    echo $calculator->applyDiscount(1000); // Output: 5


/*
    3. Liskov Substitution Principle (LSP)
    - All this is stating is that every subclass/derived class should be substitutable for their base/parent class.
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
    4. Interface Segregation->अकेलापन Principle (ISP) 
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

// Bad Example: we have tightly coupled the PasswordReminder class to the MySQLConnection
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

    public function sendReminder() {
        $this->dbConnection->connect();
        // Logic to send the password reminder goes here
        echo "Password reminder sent.";
    }
}

    // We can now pass any connection type that implements the DBConnectionInterface
    $mysqlConnection = new MySQLConnection();
    $passwordReminder = new PasswordReminder($mysqlConnection);
    $passwordReminder->sendReminder();

    // If we want to switch to PostgreSQL, we can easily do so
    $postgresConnection = new PostgreSQLConnection();
    $passwordReminder = new PasswordReminder($postgresConnection);
    $passwordReminder->sendReminder();