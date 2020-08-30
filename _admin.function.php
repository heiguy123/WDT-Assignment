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
function displaycurrent($sort, $order)
{
    if ($sort == 0 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up');   
    ";
    } elseif ($sort == 1 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up')
        ORDER BY ord.total_cost
    ";
    } elseif ($sort == 0 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up')
        ORDER BY ord.time DESC;   
    ";
    } elseif ($sort == 1 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up')
        ORDER BY ord.total_cost DESC
    ";
    }
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
            echo '<tr class="orderrow" data-toggle="modal" data-target="#exampleModal' . $row['order_id'] . '">';
            echo '<th scope="row">' . $i . '</th>';
            echo '<td> ' . $row['order_id'] . '</td>';
            echo '<td>' . $row['cus_name'] . '</td>';
            echo '<td>' . $row['payment_method'] . '</td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td>' . $row['order_status'] . '</td>';
            echo '<td>' . $row['total_cost'] . '</td>';
            echo '</tr>';
            echo '
            <div class="modal fade" id="exampleModal' . $row['order_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel' . $row['order_id'] . '" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel' . $row['order_id'] . '">Order Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body container">';
            //=======================below is the body of modal===============================
            echo '
            <div class="row details">
            <form action="" method="POST">
                <div class="col-7">
                    <input type="hidden" name="order_id" value="' . $row["order_id"] . '" readonly>
                    <p>Order ID:' . $row["order_id"] . '</p>
                    <p>Name: ' . $row['cus_name'] . '</p>
                    <p>Time: ' . $row['time'] . '</p>    
                </div>
                <div class="col-5">
               
                    <span>Status:   </span>
                    ';
            orderstatusoption($row['order_status']); //display option
            echo '    
                <br><br>   
                </div>  
            </div>
            <hr>
            ';
            display_items($row['order_id']);
            echo '
            <div class="container">
                <div class="row justify-content-between" >
                    <h6>Subtotal:</h6>
                    <h6 class="cost">' . $row['food_cost'] . '</h6>
                </div>
                <div class="row justify-content-between" >
                <h6>Delivery Cost:</h6>
                <h6 class="cost">' . $row['delivery_cost'] . '</h6>
                </div>
                <div class="row justify-content-between" >
                <b><h5>Total:</h5></b>
                <b><h5 class="cost">' . $row['total_cost'] . '</h5></b>
                </div>
            </div>
            ';

            // ======================end of modal body===========================================
            echo '      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary float-right" onclick="return confirm(\'Are you sure you want to update the status?\')">Update Status</button>
                            </form>
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
function displayclosed($sort, $order)
{
    if ($sort == 0 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Delivered' OR ord.order_status = 'Cancelled');   
    ";
    } elseif ($sort == 1 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Delivered' OR ord.order_status = 'Cancelled')
        ORDER BY ord.total_cost 
    ";
    } elseif ($sort == 0 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Delivered' OR ord.order_status = 'Cancelled')
        ORDER BY ord.time DESC;   
    ";
    } elseif ($sort == 1 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND (ord.order_status = 'Delivered' OR ord.order_status = 'Cancelled')
        ORDER BY ord.total_cost DESC
    ";
    }
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
            echo '<tr class="orderrow" data-toggle="modal" data-target="#exampleModal' . $row['order_id'] . '">';
            echo '<th scope="row">' . $i . '</th>';
            echo '<td> ' . $row['order_id'] . '</td>';
            echo '<td>' . $row['cus_name'] . '</td>';
            echo '<td>' . $row['payment_method'] . '</td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td>' . $row['order_status'] . '</td>';
            echo '<td>' . $row['total_cost'] . '</td>';
            echo '</tr>';
            echo '
            <div class="modal fade" id="exampleModal' . $row['order_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel' . $row['order_id'] . '" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel' . $row['order_id'] . '">Order Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body container">';
            //=======================below is the body of modal===============================
            echo '
            <div class="row details">
            <form action="" method="POST">
                <div class="col-8">
                    <input type="hidden" name="order_id" value="' . $row["order_id"] . '" readonly>
                    <p>Order ID:' . $row["order_id"] . '</p>
                    <p>Name: ' . $row['cus_name'] . '</p>
                    <p>Time: ' . $row['time'] . '</p>    
                </div>
                <div class="col-4 justify-content-between">
               
                    <span>Status:   </span> <span class="float-right">' . $row['order_status'] . '</span>
                    ';
            echo '    
                <br><br>
                </div>
            
            </div>
            <hr>
            ';
            display_items($row['order_id']);
            echo '
            <div class="container">
                <div class="row justify-content-between" >
                    <h6>Subtotal:</h6>
                    <h6 class="cost">' . $row['food_cost'] . '</h6>
                </div>
                <div class="row justify-content-between" >
                <h6>Delivery Cost:</h6>
                <h6 class="cost">' . $row['delivery_cost'] . '</h6>
                </div>
                <div class="row justify-content-between" >
                <b><h5>Total:</h5></b>
                <b><h5 class="cost">' . $row['total_cost'] . '</h5></b>
                </div>
            </div>
            ';
            // ======================end of modal body===========================================
            echo '      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            $i++;
        };
    }
}


function orderstatusoption($current_status)
{
    //excluded cancelled status because got cancel request management
    $sql = "SELECT DISTINCT(order_status) FROM `order_status` WHERE order_status IN ('Confirmed','Food Being Prepared','Picked Up','Delivered') ";
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    echo '<select class="float-right order_status" name="order_status">';
    if (mysqli_num_rows($result) == 0) { //if there is no record

        echo '<script>alert("Sorry, something went wrong!");
                </script>';
    } else {
        while ($row = mysqli_fetch_array($result)) {
            echo '   <option value="' . $row['order_status'] . '" ';
            if ($current_status == $row['order_status']) {
                echo 'selected';
            }
            echo '>' . $row['order_status'] . '</option>';
        }
    };
    echo '</select>';
}

//display items
function display_items($order_id)
{
    $sql = "SELECT * FROM `order_detail` ord, `food` fd WHERE ord.food_id = fd.food_id AND ord.order_id = $order_id";
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record

        echo '<script>alert("Sorry, something went wrong!");
                </script>';
    } else {
        while ($row = mysqli_fetch_array($result)) {

            $option = explode(";", $row[5]);

            for ($i = 0; $i < count($option); $i++) {
                $option[$i] = substr($option[$i], 1);
            }
            echo ' 
            <div class="row items" >
                    <div class="col-xs-3 col-md-3 item-box">
                        <img class="img-responsive" style="max-height: 130px;" src="data:image/jpeg;base64,' . base64_encode($row['picture']) . '" alt="food">
                    </div>
                    <div class="col-xs-3 col-md-5">
                        <h4 class="product-name"><strong>' . $row['name'] . '</strong></h4>';
            if (count($option) > 0 && $option[0] != "") {
                for ($i = 0; $i < count($option); $i++) {
                    echo '<h4><small>' . $option[$i] . '</small></h4>';
                }
            }
            echo '    </div>
                    <div class="col-xs-6 col-md-4 row">
                        <div class="col-xs-6 col-md-6 text-right" style="padding-top: 5px">
                            <h6><strong>' . $row['price'] . '<span class="text-muted">x</span></strong></h6>
                        </div>
                        <div class="col-xs-4 col-md-4" style="padding-top: 4px">
                            <strong>' . $row['quantity'] . '</strong>
                        </div>
                        <div class="col-xs-2 col-md-2">
                            <h5><strong>' . $row['subtotal'] . '</strong><h5>
                        </div>
                    </div>
            </div>
            <hr>
            ';
        }
    };
}


function update_orderstatus($order_id, $order_status)
{
    include("conn.php");
    $sql = "UPDATE `order` SET
            order_status='$order_status'
            WHERE order_id=$order_id;";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        echo '<script>alert("Successfully updated!");</script>';
        header('Location: admin_currentorder.php');
    }
}

//to display at the nav bar notification icon
function showrequestnumber()
{
    $sql = "SELECT COUNT(request_id) AS count FROM `order_cancel_request` WHERE `request_status` LIKE 'Pending'
    ";
    $num = 0;
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);

    if (mysqli_num_rows($result) == 0) { //if there is no record
        echo '<script>alert("Sorry, something went wrong!");
             </script>';
    } else {
        $row = mysqli_fetch_array($result);
        $num = intval($row['count']);
    }

    if ($num > 9) {
        echo "9+";
    } else if ($num > 0) {
        echo $num;
    } else {
        return;
    }
}
