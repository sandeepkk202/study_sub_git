<?php 
// Define a variable
$name = "sandeep";

//variable use string and integer
$message = 1;
$message = "PHP is Best";

echo $message."<br>";

// Print variable single or doible quotes
echo "Name in \"= $name <br>";
echo 'Name in \'= $name <br>';

//Variable Typing converting the string to integer and vice versa
$length = '10';
$breath = 20;
$area = $length*$breath;
echo "Area is =".$area."<br>";

//Variable case sensitive
$Name = "SANDEEP";
echo "$Name is not equal to $name"."<br>";

//Variable scope
$counter = 1; 
function show_counter(){
    $counter =2;
    echo "Function_counter =".$counter."<br>"; // Function_counter =2
}
 show_counter();
echo "outer_counter =$counter <br>"; // outer_counter =1

//Global Variable
global $counter;
$counter = 1;
global $counter2;
$counter2 = "hi";
function show_G_counter(){
    global $counter;
    global $counter2;
    echo "\nshow_Global_counter =".$counter."<br
>";
}
 show_G_counter();

// Static counter
function stat_counter(){
   static $count =1;
    echo $count."<br>";
    $count = $count + 1;
//    $count = "hello";
}
stat_counter();
stat_counter();
stat_counter();
stat_counter();

//Predefind variable
function print_global_variables(){
    echo "Super Global variable =".$GLOBALS['counter2']. "<br>";
}

print_global_variables();

//variable of variable
$counter_of_counter="counter2";
echo "VOV = ${$counter_of_counter}<br>";
echo "Also VOV = ".$$counter_of_counter."<br>";

//isset function
echo isset($$counter_of_counter) ? "here is set" : "not set";
    
// Define constant
/* 1.No need to use $ symbol.
   2.value can be assigned only once.
   3.contant has Global scope.
   4.you can use mathod constant(''); for value.
   5.Cannot be declared inside conditional blocks or loops (e.g., if or for) using const but can with define()
    define( NAME, VALUE);
*/    

const CONSTANT_NAME = "value"; // preferred in modern PHP
   
define( "LANGUAGE", "PHP");
    $lang = LANGUAGE;
    echo "<br>".$lang." = LANGUAGE = ".LANGUAGE;
    
// test 2
define( "LANGUAGE", "JAVA");
    echo LANGUAGE;
    
// test 3
    $LANGUAGE ="JAVA";
        echo "<br>".$LANGUAGE."=".LANGUAGE;

// test 4 isset method
//define("NAME","")
//    echo isset(NAME);
    
// test 5
echo "<br>".constant('LANGUAGE');

//---------------------------------------------------------------------------------
# Superglobals
// $GLOBALS     - Contains all global variables in the script.
// $_SERVER     - Contains information about headers, paths, and script locations.
// $_REQUEST    - Contains the combined contents of $_GET, $_POST, and $_COOKIE.
// $_POST       - Used to collect form data sent with the POST method.
// $_GET        - Used to collect data sent via URL query parameters.
// $_FILES      - Used to handle file uploads via HTTP POST.
// $_ENV        - Contains environment variables set in the server or script.
// $_COOKIE     - Contains all cookies sent by the client.
// $_SESSION    - Used to store session variables, which persist across multiple page requests for a single user.

//---------------------------------------------------------------------------------
// Magic constant 

echo "<br>Magic line".__LINE__."<br>";
echo __FILE__."<br>";
echo __DIR__."<br>";

  class trick
{
      function doit()
      {
                echo "function = ".__FUNCTION__."<br>";
      }
      function doitagain()
      {
                echo "method = ".__METHOD__;
      }
      function doitagainwithcls()
      {
                echo "class = ".__CLASS__ ;
      }

      //  __TRAIT__
      //  __NAMESPACE__
    }
$obj=new trick();
$obj->doit();
$obj->doitagain();
$obj->doitagainwithcls();
  



