<?php
logout();

function logout()
{
    session_start();
    if (isset($_SESSION['admin_row'])) { //execute this when admin session is set
        unset($_SESSION['admin_row']);
        if (!empty($_COOKIE['admin_username']) || !empty($_COOKIE['admin_password'])) {
            setcookie("admin_username", null, time() - 3600 * 24 * 365);
            setcookie("admin_password", null, time() - 3600 * 24 * 365);
        }
        header("Location: index.php");
    } elseif (isset($_SESSION['cus_row'])) { //execute this when customer session is set
        unset($_SESSION['cus_row']);
        if (!empty($_COOKIE['cus_username']) || !empty($_COOKIE['cus_password'])) {
            setcookie("cus_username", null, time() - 3600 * 24 * 365);
            setcookie("cus_password", null, time() - 3600 * 24 * 365);
        }
        header("Location: index.php");
    }
}
