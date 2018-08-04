<?php
header('Content-type: application/json');
include_once "../Functions/Import.php";
$db=Connection("placement_db");
if(isset($_POST["token"]))
{
    $email=$_POST["email"];
    $pass=$_POST["pass"];

    $qry=$db->prepare("SELECT *FROM users where email=? AND password=?");
    $qry->execute(array($email,md5($pass)));
    $count=$qry->rowCount();
    $data=$qry->fetchAll(PDO::FETCH_ASSOC);

    if($count>0)
    {
        $_SESSION["email"]=$data[0]["email"];
        $_SESSION["logged"] = "true";
        $response_array["error"] = "false";
    } else {
        $response_array["error"] = "true";
    }

    echo json_encode($response_array);
}
?>