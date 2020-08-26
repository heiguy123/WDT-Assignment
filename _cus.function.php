<?php
function havesession()
{
    session_start();
    if (!isset($_SESSION['cus_row']))        // check if session is set
    {
        if (empty($_COOKIE['cus_username']) || empty($_COOKIE['cus_password'])) { //session not found
            //if cookie is empty return false
            return false;
        } else {
            //if cookie is not empty, return true
            $cus = getcusrow($_COOKIE['cus_username'], $_COOKIE['cus_password']);
            if (empty($cus)) { //if the username and password is not valid
                return false;
            } else {
                $_SESSION['cus_row'] = $cus; //if cookies are valid, then set session, return trues
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
        alert("Please login to use myrestaurant!");
        window.location.href="login.php"; //if the cookie or session is empty, go to login
        </script>';
    }
}

function getcusrow($uname, $pword)
{
    include_once("conn.php");

    $sql = "SELECT * FROM customer WHERE username='$uname' AND password = '$pword'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) { // result must be only one record
        $cusrow = mysqli_fetch_array($result);
        mysqli_close($con);
        return $cusrow;
    } else {
        mysqli_close($con);
        return "";
    }
}
