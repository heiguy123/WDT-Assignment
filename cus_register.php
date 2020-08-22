<?php
    if (isset($_POST["submit"])) //If all the field is filled
    {
        $email = $_POST["email"];

        // Validate email structure
        function email_validation($str) { 
            return (!preg_match( 
        "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) 
                ? FALSE : TRUE; 
        } 
          
        // Function call 
        if(!email_validation("$email")) { 
            echo '<script>alert("Unsuccessfull register email! Wrong email structure!");
            window.location.href="register.php";</script>';
        } 
        else { 
            include_once("conn.php");

            $sql = "SELECT * FROM customer WHERE email = '$email'";

            $result = mysqli_query($con, $sql);

            // Validation
            if (mysqli_num_rows($result) == 1) {
                //If there is email already registered in database
                echo '<script>alert("Unsuccessfull register email! The email has been used!");
                window.location.href="register.php";</script>';
                mysqli_close($con);
            } else {
                // If there is no email in database
                mysqli_close($con);
                // header("Location:register_form.php");

                echo '<script>window.location.href="register_form.php?email="'.$email.'";</script>';
            }
        } 
    }
?>