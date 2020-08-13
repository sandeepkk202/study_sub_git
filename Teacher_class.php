<?php
require_once "University_class.php";
class teacher extends university{
    public $teaName;
    public $teaAge;
    public $subject;
    
    function __construct($name = "", $age = "", $sub = "", university $uni){
                $this->teaName = $name;
                $this->teaAge = $age;
                $this->subject = $sub;
        $this->uniName = $uni->uniName;
        $this->uniAddress = $uni->uniAddress;
        $this->licenseNo = $uni->licenseNo;
    }
    
    function printTeaDetail(){
                echo "<br>Teacher Name is : $this->teaName";
                echo "<br>Teacher Age is : $this->teaAge";
                echo "<br>Subject is : $this->subject";
     }
}
$uni1 = new university("Punjab University", "Patiala", "235");
$tea1 = new teacher("Rakul", "25", "Digital", $uni1);
$uni1->printUniDetail();
$tea1->printTeaDetail();
