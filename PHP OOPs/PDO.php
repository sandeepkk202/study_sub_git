<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mysql PDO</title>
</head>
<body>
    <h1>PDO - Check Connection</h1>
    <?php
    
//    $dns = "mysql:host=localhost;dbname=pdo";
//    $user = "root";
//    $psw = "";
//    
//    try{
//        
//        $db = new PDO($dns, $user, $psw);
//        
//    }catch(Exception $e){
//        
//        $err_msg = $e->getMessage();
//        echo "<p>Error Message : $err_msg</p>";
//        
//    }
    ?>
    
    <h2>Select Query</h2>
    <?php
    /*$query = "select * from student;";
    $dns = "mysql:host=localhost;dbname=pdo";
    $user = "root";
    $psw = "";
    
    try{
        
        $db = new PDO($dns, $user, $psw);
        
        //Prepared statment
        $statement = $db->prepare($query);
        
        //Execute the query
         $statement->execute();
        
        //fetch result
        while($student = $statement->fetch()){
            echo "ID :". $student['ID']."<br>";
            echo "Name :". $student['Name']."<br>";
        }
        
        //Close statement
        $statement->closeCursor();
        
    }catch(Exception $e){
        
        $err_msg = $e->getMessage();
        echo "<p>Error Message : $err_msg</p>";
        
    }*/
    ?>
    
    <h2>Insert Query</h2>
    <?php
    /*$query = "insert into `student`(`ID`, `Name`) values (:ID, :Name);";
    $dns = "mysql:host=localhost;dbname=pdo";
    $user = "root";
    $psw = "";
    
    try{
        
        $db = new PDO($dns, $user, $psw);
        
        //Prepared statment
        $statement = $db->prepare($query);
        
        $statement->bindValue(':ID', 5, PDO::PARAM_INT);
        $statement->bindValue(':Name', 'atul', PDO::PARAM_STR);
        
        
        //Execute the query
         if($statement->execute()){
             echo "Inserted";
         }else{
             echo "!oops";
         }

        //Close statement
        $statement->closeCursor();
        
    }catch(Exception $e){
        
        $err_msg = $e->getMessage();
        echo "<p>Error Message : $err_msg</p>";
        
    }*/
    ?>
</body>
</html>