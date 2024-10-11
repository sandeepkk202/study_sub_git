<?php 
class student{
    public $name;
    public $class;
    
//    function __construct(){
//     $this->name="sandeep";   
//     $this->class="BCA";   
//    }
    function __construct( $x = "", $y = "" ){ //with optional perameter.
     $this->name=$x;   
     $this->class=$y;   
    }
    
    function print_detail(){
        echo "my Name is $this->name and i have done $this->class.";
    }
    
    function __destruct(){
        echo "Bay";
    }
    
}

//$student = new student();
$student = new student("rahul", "B.A");

$student->print_detail();
