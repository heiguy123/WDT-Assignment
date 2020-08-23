<?php
    if (isset($_POST['submit'])) // If all the field is filled
    {
        $email = $_POST["email"];
        $username = $_POST['username'];
        $cus_name = $_POST['cus_name'];
        $gender = $_POST['gender'];
        $telcode = $_POST["telcode"];
        $tel = $_POST["tel"];
        $password = $_POST["password"];

        
        $phone_num = $telcode.$tel;
        // Validate Phone Number
        function validate_mobile($phone_num) {
            return preg_match('/^[0-9]{10}+$/', $phone_num);
        }

        // include("conn.php");

        // $sql = "INSERT INTO customer (cus_name, username, password, email, contact, gender)
                
        //         VALUES
                
        //         ('$cus_name','$username','$password','$email',
        //         '$phone_num','$gender');";

        // if (!mysqli_query($con,$sql))
        // {
        //     die ("Error: ".mysqli_error($con));
        // }

        // echo '<script>alert("1 record added!");
        // window.location.href="login.php";</script>';

        // mysqli_close($con);












    }
?>