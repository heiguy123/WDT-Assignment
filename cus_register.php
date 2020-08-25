<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST["submit"])) //If all the field is filled
    {
        $email = $_POST["email"];

        // Validate email structure
        function validate_structure($email) { 
            return (!preg_match( 
        "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) 
                ? FALSE : TRUE; 
        } 

        // Validate Email with database
        function validate_email($email) {
            include_once("conn.php");

            $sql = "SELECT * FROM customer WHERE (email='$email')";

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
          
        // Function call 
        if (!validate_structure("$email")) { 
            echo '<script>window.location.href="register.php?err=0";</script>';
        } elseif (!validate_email("$email")) {
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

                $subject = "Please verify your email";

                $body = "<center>You are almost there! We sent an email to</center><br><br>
                <center>Please <a href=".$url.">click here</a> to redirect back to fill up your information.</center><br><br>
                <center>By myrestaurant</center>";

                $mail->isHTML(true);                                     // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $body;

                $mail->send();
                echo '<script>window.location.href="verification.php?email='.$email.'";</script>';
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: '.$mail->ErrorInfo;
            }
            
        } 
    }
?>