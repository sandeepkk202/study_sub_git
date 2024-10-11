<?php
#There are 3 types of error you can find in PHP:
// Syntax Errors
// Runtime Errors
// Logic Errors

#try {} block will have all the statements
#throw is a keyword to throw an error from the program. Once the program throw an error it will stop processing the next steps. It will jump to catch {} block.
#catch {} block will be executed once the throw is called. The program will execute out from the catch block safely.
#finally{} block will execute every time irrespective of error or not. It is good place to close all open connections. Handle clean exit.


#try Catch
//try{
    //rise error in this block
    // $firstName = “”;
    // if( $firstName == “” ) 
    // throw new Exception( “Name is empty” );

//}catch(exception $exceptionObj)){
    //if try have error. it jump into this block
    // echo “Message: ” . $exceptionObj->getMessage();

//}finally{    
    //echo “This is from the Finally Block”;
//}

#some exemple------------------------------
//function simpleEx($a){
//    if( $a <= 5 ){
//        throw new Exception("less then five");
//    }else{
//        echo "ok :$a";
//    }
//}
//
//try{
//   simpleEx(2);
//    
//}catch(Exception $e){
//    echo "Exception Message:-".$e->getMessage();   
// 
//}
#------------------------------------------

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

#this is a function, if set_exception_handler() catch an error we do something like:-
function catch_error($exception){
    $x =$exception->getMessage();
    if($x == "Some Error"){
        echo "another message";
    }
}
set_exception_handler('catch_error');

throw new Exception("Some Error");