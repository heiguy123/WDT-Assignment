<?php
$username_err = '';
$password_err = '';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    include_once("conn.php");
    $sql = "SELECT * FROM admin WHERE (username='$username' OR email='$username')";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 0) {
        //if there is no record for username or email
        $username_err = "Username or Email not found!";
        mysqli_close($con);
    } elseif (mysqli_num_rows($result) == 1) {
        //if valid username or email
        $row = mysqli_fetch_array($result);
        if (password_verify($password, $row['password'])) {
            //if password matches
            session_start();
            $_SESSION["admin_row"] = $row;
            session_write_close();
            if (!empty($_POST["remember"])) {
                //if the user choose to "remember me", store the credential into cookie
                setcookie("admin_username", $username, time() + 3600 * 24 * 365);
                setcookie("admin_password", $password, time() + 3600 * 24 * 365);
            }
            mysqli_close($con);
            header("Location:admindashboard.php?welcome=welcome");
        } else {
            //if password doesnt match
            $password_err = "Invalid Password!";
            mysqli_close($con);
        }
    } else {
        echo "<script>
        alert('Something went wrong! Please try again!');
        windows.location.href('adminlogin.php');
        </script>";
    }
}
