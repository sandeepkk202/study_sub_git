<?php
class university{
    public $uniName;
    public $uniAddress;
    public $licenseNo;
    
    function __construct($name = "", $addr = "", $licno = ""){
                $this->uniName = $name;
                $this->uniAddress = $addr;
                $this->licenseNo = $licno;
    }
    
    function printUniDetail(){
                echo "<br>University Name is : $this->uniName";
                echo "<br>University Address is : $this->uniAddress";
                echo "<br>University License No. is : $this->licenseNo";
     }
}

//$uni1 = new university("punjabi University", "Patiala", "235");
//$uni1->printUniDetail();