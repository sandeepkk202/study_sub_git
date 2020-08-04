<?php
//function inputdata($a, $b){
//    try{
//        if($a <= 0 || $b <= 0){
//        throw new Exception("Error:Number must be greater then 0");
//        }else{
//        echo $result = $a / $b;
//        }
//           
//    }catch(Exception $e){
//        echo "Eception :-".$e->getMessage();
//    }
//}
//
//inputdata(0, 5);



function catch_error($exception){
    echo $exception->getMessage();
}
set_exception_handler('catch_error');

throw new Exception("Some Error");