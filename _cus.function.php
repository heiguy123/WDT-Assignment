<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

// Validate email structure
function validate_structure($email)
{
    return (!preg_match(
        "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",
        $email
    ))
        ? FALSE : TRUE;
}

// Validate Email with database
function validate_email($email, $type=0)
{
    include_once("conn.php");

    $sql = "SELECT * FROM customer WHERE (email='$email')";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        // if there is no record in database
        mysqli_close($con);
        if ($type=0) {
            return TRUE;
        } elseif ($type=1) {
            return FALSE;
        }
    } else {
        // if there is a record matched in database
        mysqli_close($con);
        if ($type=0) {
            return FALSE;
        } elseif ($type=1) {
            return TRUE;
        }
    }
}

//to send REGISTER email using phpmailer
function sendregisteremail($email)
{
    // Function call 
    if (!validate_structure($email)) { 
        echo '<script>window.location.href="register.php?err=0";</script>';
    } elseif (!validate_email($email)) {
        echo '<script>window.location.href="register.php?err=1";</script>';
    } else { 
        // Send email to from company website to recipient
        //Load composer's autoloader
        require './phpmailer/vendor/autoload.php';

        $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = 'wdtmyrestaurant2020@gmail.com';      // SMTP username
            $mail->Password = 'WDTmyrestaurant@2020';               // SMTP password
            $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                      // TCP port to connect to

            //Recipients
            $mail->setFrom('wdtmyrestaurant2020@gmail.com', 'Admin');
            $mail->addAddress($email);     // Add a recipient
            $mail->addBCC('momolau2001@gmail.com');

            //Content
            $url = "http://localhost:8080/WDT-Assignment/register_form.php?email=".$email;

            $subject = "[SIGN UP] Please verify your email";

            $body = "<center>You are almost there!</center><br><br>
            <center>Please <a href=".$url.">click here</a> to redirect back to fill up your information.</center><br><br>
            <center>By myrestaurant</center>";

            $mail->isHTML(true);                                     // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            echo '<script>window.location.href="verification.php?email='.$email.'&type=register";</script>';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: '.$mail->ErrorInfo;
        }
        
    } 
}

// to send RESET PASSWORD eamil using phpmailer
function sendresetemail($email) 
{
    // Function call 
    if (!validate_structure($email)) { 
        echo '<script>window.location.href="forgot.php?err=0";</script>';
    } elseif (!validate_email($email,1)) {
        echo '<script>window.location.href="forgot.php?err=1";</script>';
    } else { 
        // Send email to from company website to recipient
        //Load composer's autoloader
        require './phpmailer/vendor/autoload.php';

        $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = 'wdtmyrestaurant2020@gmail.com';      // SMTP username
            $mail->Password = 'WDTmyrestaurant@2020';               // SMTP password
            $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                      // TCP port to connect to

            //Recipients
            $mail->setFrom('wdtmyrestaurant2020@gmail.com', 'Admin');
            $mail->addAddress($email);     // Add a recipient
            $mail->addBCC('momolau2001@gmail.com');

            //Content
            $url = "http://localhost:8080/WDT-Assignment/reset_password.php?email=".$email;

            $subject = "[RESET PASSWORD] Please verify your email";

            $body = "<center>You are almost there!</center><br><br>
            <center>Please <a href=".$url.">click here</a> to redirect back to reset your password.</center><br><br>
            <center>By myrestaurant</center>";

            $mail->isHTML(true);                                     // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            echo '<script>window.location.href="verification.php?email='.$email.'&type=forgot";</script>';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: '.$mail->ErrorInfo;
        }
        
    } 
}

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

// Validate Phone Number
function validate_mobile($telcode,$tel) {
    $phone_num = $telcode.$tel;
    return preg_match('/^[0-9]{10}+$/', $phone_num)
    ? FALSE : TRUE; 
}

// Validate Password
function validate_password($password, $re_pasword)
{
    if ($password == $re_pasword) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function resetpassword($email, $password, $re_pasword)
{
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

function logout()
{
    session_start();
    unset($_SESSION['cus_row']);
    if (!empty($_COOKIE['cus_username']) || !empty($_COOKIE['cus_password'])) {
        setcookie("cus_username", null, time() - 3600 * 24 * 365);
        setcookie("cus_password", null, time() - 3600 * 24 * 365);
    }
    header("Location: index.php");
}
?>
