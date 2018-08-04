<?php
    require_once("../Functions/Import.php");
    if(isset($_POST["validate"]) && $_POST["validate"] == "email") {
        $response = EmailExists($_POST["email"]) == 0 ? true : false;
        echo json_encode(array('valid' => $response));
    }

