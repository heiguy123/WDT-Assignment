<?php
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
            $password_err = "Password are not matched!";
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

        // Validate Username
        function validate_username($username) {
            include_once("conn.php");

            $sql = "SELECT * FROM customer WHERE (username='$username')";

            $result = mysqli_query($con, $sql);


            if (mysqli_num_rows($result) == 1) {
                //if there is a record in database
                mysqli_close($con);
                return FALSE;
            } else {
                //if there is no record in database
                mysqli_close($con);
                return TRUE;
            }
        }


        $phone_num = $telcode.$tel;
        // Validate Phone Number
        function validate_mobile($phone_num) {
            return preg_match('/^[0-9]{10}+$/', $phone_num)
            ? FALSE : TRUE; 
        }

        // Validate Password
        function validate_password($password,$re_pasword) {
            if ($password == $re_pasword) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        // Function call
        if (!validate_username("$username")) {
            echo '<script>window.location.href="register_form.php?email='.$email.'&err=0";</script>';
        } elseif (!validate_mobile("$phone_num")) {
            echo '<script>window.location.href="register_form.php?email='.$email.'&err=1";</script>';
        } elseif (!validate_password("$password","$re_pasword")) {
            echo '<script>window.location.href="register_form.php?email='.$email.'&err=2";</script>';
        } else {
            // Validation PASS
            include("conn.php");

            $sql = "INSERT INTO customer (cus_name, username, password, email, contact, gender)
                    
                    VALUES
                    
                    ('$cus_name','$username','$password','$email',
                    '$phone_num','$gender');";

            if (!mysqli_query($con,$sql))
            {
                die ("Error: ".mysqli_error($con));
            }

            echo '<script>alert("Welcome '.$cus_name.',You have successfully registered!");
            window.location.href="login.php";</script>';

            mysqli_close($con);
        }
    }
?>