<?php
    include_once("_cus.function.php");

    if (!isset($_GET['err'])) {
        $password_err = '';
    } else {
        $password_err = "Password are not matched!";
    }


    if (isset($_POST['submit'])) // If all the field is filled
    {
        resetpassword($_POST["email"],$_POST["password"],$_POST["re_password"]);
    }
?>