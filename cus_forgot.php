<?php
    include_once("_cus.function.php");

    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST["submit"])) //If all the field is filled
    {
        sendresetemail($_POST['email']);
    }
?>