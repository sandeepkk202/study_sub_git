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

# Mathod 1
$fileName = "testing.php";

# Get content
$content = file_get_contents($fileName);
echo $content."<hr>";
    
# Method 2
# Open a file
//$fileHandler = fopen($fileName, "r");
//$fileSize = filesize($fileName);

# Read the file content
//$content = fread($fileHandler, $fileSize);
//echo $content;

# Close the file
//fclose($fileHandler);

# Write file - method1
//$fileHandler = fopen($fileName, "w") or die("Unable to write the file");
//fwrite($fileHandler, "This is the line new added");
//fclose($fileHandler);

# Write file - method2
//file_put_contents($fileName, "This the modified by file_put_content() function"); //Rewrite

# Read config file like (.ini)
$fileIni = "testing2.ini";
$settings = parse_ini_file($fileIni);
print_r($settings); echo "<hr>";//you can use for it foreach or array element[] as well

# Read and write CSV data
$fileCsv = "testing.csv";
//$content = file_get_contents($fileCsv); //read entire content
//print_r($content); echo "<hr>";
#
//$csvFile = file($fileCsv);  //read line by line
//var_dump($csvFile);
//foreach($csvFile as $x){
//    $data[] = str_getcsv($x); //also use
//        print_r($data);
//}
#
//$csv = array_map('str_getcsv', file($fileCsv));
//print_r($csv);

#File exercise
#Creat file
//$file_ref = fopen("newfile.txt", "w"); //""Create a file""
//
//fwrite($file_ref, "This is the new file");  //""Write a file""
//
//fclose($file_ref); //""Save a file""

#Read file
//file_put_contents("newfile.txt", "Read file exercise", FILE_APPEND); //Append content in file
//
//$file_ref = fopen("newfile.txt", "r"); //""Create/Read a file""
//
//$content = fread($file_ref,filesize("newfile.txt"));
//
//echo $content;
//fclose($file_ref); //""Save a file""
