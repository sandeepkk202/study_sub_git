<?php
#  php -S localhost:8000
// include_once __DIR__."\Controller\AnotherController.php";

// include_once "Function.php";
// include_once "AnotherCls.php";


spl_autoload_register(function ($classname){
  echo "Loading class: $classname <br>" . PHP_EOL;
 require_once "$classname.php";
});

$AnotherCls = new AnotherCls();

// accessMe();
$result = $AnotherCls->checkTime();
// var_dump($AnotherCls->myFunction($result));