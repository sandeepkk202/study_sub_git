<?php
// data hide is encapsulation
class student{
    private $id = "";
    private $name = "";
    private $class = "";
    
    public function getStudentData($id, $name, $class){
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
    }
    
    public function setStudentData(){
        $arr = [];
        $arr[] = $this->id;
        $arr[] = $this->name;
        $arr[] = $this->class;
        return($arr);
    }
    
}

$obj1 = new student();
$obj1->getStudentData("1", "ram", "lkg");
$value = $obj1->setStudentData();
//var_dump($value);
foreach($value as $x)
    echo $x."<br>";