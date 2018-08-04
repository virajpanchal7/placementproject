<?php
include_once "../Functions/Import.php";
$db=Connection("placement_db");
$response_array= array();
if(isset($_POST["token"]))
{
    $email=$_POST["email"];
    $pass=md5($_POST["pass"]);
    $username=$_POST["username"];
    

    $query = $db->prepare("INSERT INTO users VALUES (:username,:password,:email)");
    $query->bindParam ( ':username' , $username , PDO::PARAM_STR ) ;
    $query->bindParam ( ':password' , $pass , PDO::PARAM_STR ) ;
	$query->bindParam ( ':email' , $email , PDO::PARAM_STR ) ;
    $query->execute();

   
    return true;
}
?>