<?php
    include_once("_cus.function.php");

    if (isset($_POST["submit"])) //If all the field is filled
    {
        sendresetemail($_POST['email']);
    }
?>