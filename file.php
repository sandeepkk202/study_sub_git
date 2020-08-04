<?php 
//Sample 1: List all files in a Directory
//scandir();

$path = "Testfolder1";
$result = scandir($path);
//var_dump($result);
foreach($result as $dir)
if($dir != "." && $dir !=".." )
    echo $dir.", ";//var_dump($dir);
echo "<hr>";

//remove . and ..
$directory = array_diff($result, ['.', '..']);
var_dump($directory); echo "<hr>";    
foreach($directory as $x)
    echo $x.", ";

//Sample 2:  Check for specific Files or Directory
// is_file(); or is_dir();
echo "<hr>";
$result = scandir($path);
$directory = array_diff($result, ['.', '..']);
  foreach( $directory as $dir )
  {
      if(is_file($path."/". $dir)){
          echo $dir.", ";
      }
      //if(is_dir($path."/". $dir)){
        //  echo $dir.", ";
      //}
  }
echo "<hr>";

//Create a Directory
$result = glob("*.php");
var_dump($result);

if(!file_exists("mkfolder")){
    mkdir("mkfolder");
}

//copy files
copy("Testfolder1/hello","mkfolder/hello");
