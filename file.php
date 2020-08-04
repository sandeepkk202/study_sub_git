<?php 
#Sample 1: List all files in a Directory
#scandir();

$path = "Testfolder1";
$result = scandir($path);
////var_dump($result);

#Glob
//$result = glob("*.php");
//var_dump($result);

//foreach($result as $dir)
//if($dir != "." && $dir !=".." )
//    echo $dir.", ";//var_dump($dir);
//echo "<hr>";

#remove . and ..
//$directory = array_diff($result, ['.', '..']);
//var_dump($directory); echo "<hr>";    
//foreach($directory as $x)
//    echo $x.", ";

#Sample 2:  Check for specific Files or Directory
# is_file(); or is_dir();
//echo "<hr>";
//$directory = array_diff($result, ['.', '..']);
//  foreach( $directory as $dir )        
//  {
//      if(is_file($path."/". $dir)){
//          echo $dir.", ";
//      }
//      if(is_dir($path."/". $dir)){
//          echo $dir.", ";
//      }
//  }
//echo "<hr>";

//echo "<hr>";
#Create a Directory

//if(!file_exists("mkfolder")){
//    mkdir("mkfolder");
//}

#Copy, Rename, Delete of a file
#copy("$path/myfile.php","to/new_file_name.php");
//copy("Testfolder1/hello","mkfolder/hello");

#Check file is exists?
//if(file_exists($path)){
//    if(is_dir($path)){
//            echo "<br>It is a directory not a file";
//        }else{
//            echo "File exist"; 
////        copy("file.php","newcopy.php");  //copy file
////        rename("newcopy.php","renamefile.php"); //rename file
////        unlink("renamefile.php");  // delete file
//        
//        }
//}else{
//    echo "File / Directory does is not exist";
//    die("<br>No such files");
//}

#Read and Write Files
//Three steps follow 1. Open file, 2. Read file content, 3. Close the file 

//r Reade mode
//w Write mode
//a append mode "last of the line"