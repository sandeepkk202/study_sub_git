<?php
// include_once "First.php";

class AnotherCls extends First{

  function myFunctiom()  {    
    $time = "12345678";
    $data = ['time' => $time, 'string' => "aaaaaaaa"];
    $headers = "application/json";
    return $this->response($data)->json();
    // echo "yahoo";
  }

  function myFunction($data){
    return $this->response($data)->toArray();
  }

}

