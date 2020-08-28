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
    } else {
        //if valid username or email
        $sql = "SELECT * FROM customer WHERE (username='$username' OR email='$username') AND password = '$password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0) {
            //if password doesnt match
            $password_err = "Invalid Password!";
            mysqli_close($con);
        } else {
            //if password matches

            $row = mysqli_fetch_array($result);
            $_SESSION["cus_row"] = $row;

            if (!empty($_POST["remember"])) { //if the user choose to "remember me", store the credential into cookie
                setcookie("cus_username", $username, time() + 3600 * 24 * 365);
                setcookie("cus_password", $password, time() + 3600 * 24 * 365);
            }

            mysqli_close($con);
            header("Location:dashboard.php?welcome=welcome");
        }
    }
}
