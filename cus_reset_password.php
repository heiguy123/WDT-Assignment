<?php
    if (!isset($_GET['err'])) {
        $password_err = '';
    } else {
        $password_err = "Password are not matched!";
    }


    if (isset($_POST['submit'])) // If all the field is filled
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $re_pasword = $_POST["re_password"];

        // Validate Password
        function validate_password($password,$re_pasword) {
            if ($password == $re_pasword) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        // Function call
        if (!validate_password("$password","$re_pasword")) {
            echo '<script>window.location.href="reset_password.php?email='.$email.'&err=0";</script>';
        } else {
            // Validation PASS
            include_once("conn.php");

            $sql = "UPDATE customer SET password = '$password' WHERE email = '$email';";

            if (!mysqli_query($con,$sql))
            {
                die ("Error: ".mysqli_error($con));
            }

            echo '<script>alert("You have successfully reset your password. Please proceed to login page.");
             window.location.href="login.php";</script>';

            mysqli_close($con);
        }
    }
?>