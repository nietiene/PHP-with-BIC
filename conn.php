<?php
try{
    $conn=new PDO("mysql:host=localhost; dbname=hospital",  "root", "factorise@123");
    echo"connected";
}
catch(PDOException $err){

    echo"ERROR:".$err -> getMessage();
}


?>