<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$totalorder = -1;
$confirmedorder  = -1;
$preparedorder = -1;
$deliveringorder = -1;
$completedorder  = -1;
$cancelledorder  = -1;


function setdashboardnumber()
{
    include('conn.php');
    //completed order
    $sql = 'SELECT COUNT(order_id) FROM `order` WHERE `order_status` LIKE "Delivered";';
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) { //if there is no record
        $row = mysqli_fetch_array($result);
        global $completedorder;
        $completedorder = $row[0];
    }
    //total order
    $sql = 'SELECT COUNT(order_id) FROM `order`;';
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) { //if there is no record
        $row = mysqli_fetch_array($result);
        global $totalorder;
        $totalorder = $row[0];
    }

    //confirmed order
    $sql = 'SELECT COUNT(order_id) FROM `order` WHERE `order_status` LIKE "Confirmed";';
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) { //if there is no record
        $row = mysqli_fetch_array($result);
        global $confirmedorder;
        $confirmedorder = $row[0];
    }
    //prepared order
    $sql = 'SELECT COUNT(order_id) FROM `order` WHERE `order_status` LIKE "Food Being Prepared";';
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) { //if there is no record
        $row = mysqli_fetch_array($result);
        global $preparedorder;
        $preparedorder = $row[0];
    }
    //delivering order
    $sql = 'SELECT COUNT(order_id) FROM `order` WHERE `order_status` LIKE "Picked Up";';
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) { //if there is no record
        $row = mysqli_fetch_array($result);
        global $deliveringorder;
        $deliveringorder = $row[0];
    }
    //cancelled order
    $sql = 'SELECT COUNT(order_id) FROM `order` WHERE `order_status` LIKE "Cancelled";';
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) { //if there is no record
        $row = mysqli_fetch_array($result);
        global $cancelledorder;
        $cancelledorder = $row[0];
    }


    mysqli_close($con);
}


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
function validate_email($email)
{
    include_once("conn.php");

    $sql = "SELECT * FROM admin WHERE (email='$email')";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        //if there is no record in database
        mysqli_close($con);
        return FALSE;
    } else {
        //if there is a record matched in database
        mysqli_close($con);
        return TRUE;
    }
}

//to send email using phpmailer
function sendforgotemail($email)
{
    // Function call
    if (!validate_structure("$email")) {
        echo '<script>
        window.location.href = "adminforgot.php?err=0";
    </script>';
    } elseif (!validate_email("$email")) {
        echo '<script>
        window.location.href = "adminforgot.php?err=1";
    </script>';
    } else {
        // Send email to from company website to recipient
        //Load composer's autoloader
        require './phpmailer/vendor/autoload.php';

        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'wdtmyrestaurant2020@gmail.com'; // SMTP username
            $mail->Password = 'WDTmyrestaurant@2020'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('wdtmyrestaurant2020@gmail.com', 'SuperAdmin');
            $mail->addAddress($email); // Add a recipient
            $mail->addBCC('momolau2001@gmail.com');
            $mail->addBCC('howard_bb@hotmail.com');

            //Content
            $url = "http://localhost:8080/WDT-Assignment-master/WDT-Assignment/adminresetpass.php?email=" . $email;

            $subject = "[RESET PASSWORD] Please verify your email";

            $body = "<center>You are almost there!</center><br><br>
                <center>Please <a href=" . $url . ">click here</a> to redirect back to reset your password.</center><br><br>
                <center>By myrestaurant</center>";

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            echo '<script>
                window.location.href = "admin_verification.php?email=' . $email . '&type=forgot";
                </script>';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            echo '<br>Please try again!';
        }
    }
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
    if (!validate_password("$password", "$re_pasword")) {
        echo '<script>window.location.href="adminresetpass.php?email=' . $email . '&err=0";</script>';
    } else {
        // Validation PASS
        include_once("conn.php");

        $sql = "UPDATE admin SET password = '$password' WHERE email = '$email';";

        if (!mysqli_query($con, $sql)) {
            die("Error: " . mysqli_error($con));
        }

        echo '<script>alert("You have successfully reset your password. Please proceed to admin login page.");
         window.location.href="adminlogin.php";</script>';

        mysqli_close($con);
    }
}



//display for current order
function displaycurrent()
{
    //                 <tr>
    //                     <th scope="row">1</th>
    //                     <td>Mark</td>
    //                     <td>Otto</td>
    //                     <td>@mdo</td>
    //                 </tr>
    //                 <tr>
    //                     <th scope="row">2</th>
    //                     <td>Jacob</td>
    //                     <td>Thornton</td>
    //                     <td>@fat</td>
    //                 </tr>
    //                 <tr>
    //                     <th scope="row">3</th>
    //                     <td>Larry</td>
    //                     <td>the Bird</td>
    //                     <td>@twitter</td>
    //                 </tr>


    // ===============BELOW WILL BE OPEN WHEN SEARCH FUNCTION IS AVAILABLE
    // if (isset($_GET['searchname']) && $_GET['searchname'] != '') {  //this is run when the submit button is clicked and the search item isnt null

    //     $sql = "SELECT * FROM contacts  WHERE contact_name LIKE '%" . $_GET['searchname'] . "%'";
    // } elseif (!isset($_GET['searchname'])) {  //this will show all

    //     $sql = "SELECT * FROM contacts";
    // } elseif ($_GET['searchname'] == '') {  //this is run when the given name to search is blank

    //     header('Location:new_view.php');
    // }

    $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
    WHERE ord.cus_id = cus.cus_id 
    AND ord.payment_id = pay.payment_id 
    AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up');   
    ";

    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);

    if (mysqli_num_rows($result) == 0) { //if there is no record
        echo '<script>alert("Sorrt something went wrong D:");
                </script>';
    } else {
        //1st create a container
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {

            echo '<tr class="orderrow" data-toggle="modal" data-target="#exampleModal' . $i . '">';
            echo '<th scope="row">' . $i . '</th>';
            echo '<td>' . $row['order_id'] . '</td>';
            echo '<td>' . $row['cus_name'] . '</td>';
            echo '<td>' . $row['payment_method'] . '</td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td>' . $row['order_status'] . '</td>';
            echo '<td>' . $row['total_cost'] . '</td>';
            echo '</tr>';


            echo '
            <div class="modal fade" id="exampleModal' . $i . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel' . $i . '" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel' . $i . '">Order Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body container">';

            echo '
            <div class="row details">
                <div class="col-6">
                    <p>Order ID: ' . $row["order_id"] . '</p>
                    <p>Name: ' . $row['cus_name'] . '</p>
                    <p>Time: ' . $row['time'] . '</p>    
                </div>
                <div class="col-6">
                    <span>Status: </span>
                    ';



            echo '   
                </div>
            
            </div>
            ';

            echo '      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            ';

            $i++;
        };
    }
}

//display for completed order
function displayclosed()
{
}


function orderstatusoption()
{
    $sql = 'SELECT DISTINCT(order_status) FROM `order_status`';
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    echo '<select name="order_status" id="order_status">';
    if (mysqli_num_rows($result) == 0) { //if there is no record

        echo '<script>alert("Sorry, something went wrong!");
                </script>';
    } else {
        echo '   <option value="' . $row['order_status'] . '">' . $row['order_status'] . '</option>
                
        ';
    };


    echo '</select>';
}

// <option value="volvo">Volvo</option>
// <option value="saab">Saab</option>
// <option value="mercedes">Mercedes</option>
// <option value="audi">Audi</option>
