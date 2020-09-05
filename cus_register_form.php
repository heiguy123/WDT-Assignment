<?php
    include_once("_cus.function.php");

    if (!isset($_GET['err'])) {
        $username_err = '';
        $contact_err = '';
        $password_err = '';
    } else {
        $err = $_GET['err'];

        if ($err == 0) {
            $username_err = "Username existed!";
            $contact_err = '';
            $password_err = '';
        } elseif ($err ==1) {
            $contact_err = "Invalid Contact Number!";
            $username_err = '';
            $password_err = '';
        } elseif ($err == 2) {
            $password_err = "Password are not matched or your password is not valid!";
            $username_err = '';
            $contact_err = '';
        }
    }


    if (isset($_POST['submit'])) // If all the field is filled
    {
        $email = $_POST["email"];
        $username = $_POST['username'];
        $cus_name = $_POST['cus_name'];
        $gender = $_POST['gender'];
        $telcode = $_POST["telcode"];
        $tel = $_POST["tel"];
        $password = $_POST["password"];
        $re_pasword = $_POST["re_password"];

        $phone_num = $telcode.$tel;

        // Function call
        if (!validate_username($username)) {
            echo '<script>window.location.href="register_form.php?email='.$email.'&err=0";</script>';
        } elseif (!validate_mobile($telcode,$tel)) {
            echo '<script>window.location.href="register_form.php?email='.$email.'&err=1";</script>';
        } elseif (!validate_password($password,$re_pasword)) {
            echo '<script>window.location.href="register_form.php?email='.$email.'&err=2";</script>';
        } else {
            // Validation PASS

            // setting encryted password
            $enc_pass = getEncryptedPassword($password);

            include("conn.php");

            $sql = "INSERT INTO customer (cus_name, username, password, email, contact, gender)
                    
                    VALUES
                    
                    ('$cus_name','$username','$enc_pass','$email',
                    '$phone_num','$gender');";

            if (!mysqli_query($con,$sql))
            {
                die ("Error: ".mysqli_error($con));
            } else {
                // insert cart for it
                
                $sql = "INSERT INTO cart (cus_id)
                    
                    VALUES
                    
                    ((SELECT `cus_id` FROM `customer` WHERE `username` = '$username'));";

                if (mysqli_query($con,$sql))
                {
                    echo '<script>alert("Welcome '.$cus_name.',You have successfully registered!");
                    window.location.href="login.php";</script>';
                }
            
                mysqli_close($con);
            }
        }
    }
?>