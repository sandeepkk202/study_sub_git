<?php

// include_once "Helper.php";

class First{

  use Helper;
  
  private $data;
  
  public function response($data){
    $this->data = $data;
    return $this;
  }

  function json() {
    return json_encode($this->data);
  }

  function toArray() {
    return json_decode($this->data);
  }
}

