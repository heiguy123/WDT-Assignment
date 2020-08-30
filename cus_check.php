<?php
$username_err = '';
$password_err = '';
if (isset($_POST['submit'])) {
    // if both field is filled
    $username = $_POST['username'];
    $password = $_POST['password'];


    include_once("conn.php");


    $sql = "SELECT * FROM customer WHERE (username='$username' OR email='$username')";

    $result = mysqli_query($con, $sql);


    if (mysqli_num_rows($result) == 0) {
        //if there is no record for username
        $username_err = "Username or Email not found!";
        mysqli_close($con);
    } elseif (mysqli_num_rows($result) == 1) {
        //if valid username or email
        $sql = "SELECT * FROM customer WHERE (username='$username' OR email='$username') AND password = '$password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0) {
            //if password doesnt match
            $password_err = "Invalid Password!";
            mysqli_close($con);
        } else {
            $row = mysqli_fetch_array($result);
            // session_start();

            // get address if there is
            $sql = "SELECT `address`,`city`,`postcode` FROM `user_address` WHERE `cus_id` = $row[0] ORDER BY `add_id` DESC";
            $result = mysqli_query($con,$sql);

            if (mysqli_num_rows($result) > 0) {
                //there is add(s) in database
                $add_row = mysqli_fetch_array($result);
                $add = $add_row['address'].','.$add_row['city'].','.$add_row['postcode'];
                
                $_SESSION['cus_row'] = $row;
                $_SESSION['cus_row']['address'] = $add;
                session_write_close();
            } else {
                //there is no add in database, set zero add into session
                $_SESSION['cus_row'] = $row;
                $_SESSION['cus_row']['address'] = "";
                session_write_close();
            }

            if (!empty($_POST["remember"])) { //if the user choose to "remember me", store the credential into cookie
                setcookie("cus_username", $username, time() + 3600 * 24 * 365);
                setcookie("cus_password", $password, time() + 3600 * 24 * 365);
            }

            mysqli_close($con);
            header("Location:dashboard.php");
        }
    } else {
        echo "<script>
        alert('Something went wrong! Please try again!');
        windows.location.href('login.php');
        </script>";
    }
}