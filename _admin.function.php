<?php
function havesession()
{
    session_start();
    if (!isset($_SESSION['admin_row']))        // check if session is set
    {
        if (empty($_COOKIE['admin_username']) || empty($_COOKIE['admin_password'])) { //session not found
            //if cookie is empty return false
            return false;
        } else {
            //if cookie is not empty, return true
            $admin = getadminrow($_COOKIE['admin_username'], $_COOKIE['admin_password']);
            if (empty($admin)) { //if the username and password is not valid
                return false;
            } else {
                $_SESSION['admin_row'] = $admin; //if cookies are valid, then set session, return trues
                return true;
            }
        }
    }
    //if have session, return true
    return true;
}

function checksession()
{
    if (havesession() == false) {
        echo '<script>
        alert("Please login as admin!");
        window.location.href="adminlogin.php";//if the cookie or session is empty, go to login
        </script>';
    }
}

function getadminrow($uname, $pword)
{
    include_once("conn.php");

    $sql = "SELECT * FROM admin WHERE username='$uname' AND password = '$pword'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) { //result must be only one record
        $adminrow = mysqli_fetch_array($result);
        mysqli_close($con);
        return $adminrow;
    } else {
        mysqli_close($con);
        return "";
    }
}
