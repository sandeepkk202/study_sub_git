<?php 

$arr=[1,"2",3.7];

# funaction to print array
 
    var_dump($arr);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# Human readable   
//    print_r($arr);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# ACCESS AND PRINT ARRAY
//    echo "$arr[1]";
//    echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
//    echo $arr[1];
//    echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
    
# $arr is a Array Variable
# $arr[0] is a Array Element
# 0 is a index of Array 

# Array has a length based on the number of the element it has.
//echo "Array length : ".count($arr);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";    
# Loop thru the array using for loop
//for($x=0; $x < count($arr); $x++)
//    echo $arr[$x].",";

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# Access array element inside the string using Constant
//const ARRAY_ELEMENT = 1;
//echo "{$arr[ARRAY_ELEMENT]}";

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# Foreach loop
//$arr = ["sun", "mon", "tus", "wed", "thu", "fri", "sat"];
//foreach($arr as $x)
//    echo $x.", ";

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# Unset array (delete)
//unset($arr[6]);
//echo var_dump($arr);

echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# ================ ASSOCIATIVE ARRAY ================
# ASSOCIATIVE array is pair of "key and value"
$arr = ["sun" => "Sunday", "mon" => "Monday", "tus" => "Tusday", "wed" => "Wednesday", "thu" => "Thursday", "fri" => "Friday", "sat" => "Saturday"];
var_dump($arr);
//foreach($arr as $xKey => $xValue)
//    echo $xKey."=>"."$xValue<br>";

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# assinge value in associated Array
//$arr["another"] = "day";
//echo var_dump($arr);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# accesse Array value
//echo $arr["tus"];

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# change value of a key
//$arr["mon"] = "somvar";
//echo var_dump($arr);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# PRINT THE KEY
//print_r(array_keys($arr));

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# ACCESS ONLY THE KEYS
//foreach(array_keys($arr) as $xKey)
//    echo $xKey." , ";

echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# mixed index & associatev array
$arr =[ 1 => "sunday", 2 => "monday", "tus" => "Tusday", "wed" => "Wednesday", "thu", "fri", "sat" ,"&" => "and"];
echo var_dump($arr);

echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
#  MULTI Dimenssion Array like = [[]] *array inside array*
$arr=[[0,1,2,3,4],[5,6,7],[8,9]];
echo var_dump($arr);

//echo "<br>===========================<br>";
//foreach($arr as $topValue)
//    echo var_dump($topValue);

//echo "<br>======================================<br>";
//foreach($arr as $topValue){
//    echo "[";
//    foreach($topValue as $innerValue)
//        echo $innerValue." , ";
//    echo "]";
//}

echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
#-------------------------- key is a string and value is array ---------------------------------
$arr = ["three" => ["sun" => "Sunday", "mon" => "Monday", "tus" => "Tusday"], 
        "another_day" => ["wed" => "Wednesday", "thu" => "Thursday", "fri" => "Friday", "sat" => "Saturday"]
       ];
echo var_dump($arr);

//echo "<br>===========================<br>";
//foreach($arr as $xValue)
//    echo var_dump($xValue);

//echo "<br>======================================<br>";
//foreach($arr as $topValue){
//    echo "[";
//    foreach($topValue as $innerValue)
//        echo $innerValue." , ";
//    echo "], ";}

//echo "<br>================================================<br>";
//foreach($arr as $topKey => $topValue){
//    echo "$topKey"."[";
//    foreach($topValue as $innerValue)
//        echo $innerValue." , ";
//    echo "], ";}

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# sort() and rsort() for Indexed Array
//$arr =[3,5,2,4,1];
//print_r($arr);
//echo "<br>"; 
//sort($arr);
//print_r($arr);
//echo "<br>"; 
//rsort($arr);
//print_r($arr);

//echo "<br>===========================<br>";
# asort() and arsort() for Associative Array sort by value
//$arr =["2" => "john", "3" => "rahul", "1" => "kumar"];
//print_r($arr);
//echo "<br>"; 
//asort($arr);
//print_r($arr);
//echo "<br>"; 
//arsort($arr);
//print_r($arr);

//echo "<br>=====================================<br>";
# ksort() and krsort() for Associative Key Array sort by key
//$arr =["2" => "john", "3" => "rahul", "1" => "kumar"];
//print_r($arr);
//echo "<br>"; 
//ksort($arr);
//print_r($arr);
//echo "<br>"; 
//krsort($arr);
//print_r($arr);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";
# COPY ARRAY

# Sample 1
//$arr =[3,5,2,4,1];
//$arr1 = $arr;
//print_r($arr1);
//echo "<br>";

# sample 2
//foreach($arr as $x)
//    $arr2[] = $x;
//print_r($arr2);
//echo "<br>";

# sample 3
//$arr3 = ["2" => "john", "3" => "rahul", "1" => "kumar"];
//$arr4 = $arr3;
//print_r($arr4);
//echo "<br>";

# sample 4
//$arr5 = [];
//foreach($arr3 as $xKey => $x)
//    $arr5[$xKey] = $x;
//print_r($arr5);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";

# Convert STRING TO ARRAY
//$days = "mon, tus, wed, thu, fri, sat";
//$days_arr = explode(",",$days);
//print_r($days_arr);

# Convert ARRAY TO STRING 
//echo "<br>";
//$days_str = implode(",",$days_arr);
//print_r($days_str);

# Limited no of array element
//echo "<br>";
//$Limited_days = explode(",", $days, 3);
//print_r($Limited_days);

//echo "<br><b>Line no.".__LINE__."</b>"."<hr>";

# Array Exercise
//$company = [
//    "boss" => [
//        "Teamleader" => [ "Sandeep" => [ "Ashish" => "PHP" ],
//                         "Asmita" => [ "Ritu" => "SEO", "priya" => "SEO" ], 
//                         "Gurpreet" => [ "Sonu" => "SEO", "Manpreet" => "SEO"], 
//                        ]   
//             ]
//            ];

//foreach($company as $coKey => $co ){
//       echo $coKey." = ";
//    foreach($co as $LeaderKey => $leader )
//        echo $LeaderKey." = ";
//    foreach($leader as $namerKey => $name){
//        echo "<br>".$namerKey." = ";
//            foreach($name as $employeename => $Profile){
//                echo $employeename." = ".$Profile.", ";
//            }
//    }
//}
 
    