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


function orderstatusoption($current_status)
{
    //excluded cancelled status because got cancel request management
    $sql = "SELECT DISTINCT(order_status) FROM `order_status` WHERE order_status IN ('Confirmed','Food Being Prepared','Picked Up','Delivered') ";
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    echo '<select class="float-right order_status" name="order_status">';
    if (mysqli_num_rows($result) == 0) { //if there is no record

        echo '<script>alert("Sorry, something went wrong! caller:orderstatusoption");
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
        echo '<script>alert("Sorry, something went wrong! caller:displayitem");
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
        echo '<script>alert("Sorry, something went wrong! caller: showrequestnumber");
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


//display for current order
function displaycurrentsearch($sort, $order, $searchname)
{
    if ($sort == 0 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
        AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up');   
    ";
    } elseif ($sort == 1 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
        AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up')
        ORDER BY ord.total_cost
    ";
    } elseif ($sort == 0 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
        AND (ord.order_status = 'Confirmed' OR ord.order_status = 'Food Being Prepared' OR ord.order_status = 'Picked Up')
        ORDER BY ord.time DESC;   
    ";
    } elseif ($sort == 1 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
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


//display for closed order when searched
function displayclosedsearch($sort, $order, $searchname)
{
    if ($sort == 0 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
        AND (ord.order_status = 'Delivered' OR ord.order_status = 'Cancelled');   
    ";
    } elseif ($sort == 1 && $order == 0) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
        AND (ord.order_status = 'Delivered' OR ord.order_status = 'Cancelled')
        ORDER BY ord.total_cost 
    ";
    } elseif ($sort == 0 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
        AND (ord.order_status = 'Delivered' OR ord.order_status = 'Cancelled')
        ORDER BY ord.time DESC;   
    ";
    } elseif ($sort == 1 && $order == 1) {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `payment` pay 
        WHERE ord.cus_id = cus.cus_id 
        AND ord.payment_id = pay.payment_id 
        AND cus.cus_name LIKE '%" . $searchname . "%'
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

function displaymenulist()
{
    searchmenu("");
}

//to display all/searched food menu
function searchmenu($searchitem)
{
    if (empty($searchitem)) {
        $sql = "SELECT * FROM `food` fd, `food_category` fc 
        WHERE fd.cate_id = fc.cate_id
        ORDER BY fc.category_name;   
    ";
    } else {
        $sql = "SELECT * FROM `food` fd, `food_category` fc 
        WHERE fd.cate_id = fc.cate_id
        AND fd.name LIKE '%" . $searchitem . "%'
        ORDER BY fc.category_name;   
    ";
    }

    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        echo '<script>alert("Sorrt something went wrong! caller: searchmenu");
                </script>';
    } else {
        $i = 1;
        $currentcate = "something";
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr class="orderrow" data-toggle="modal" data-target="#exampleModal' . $row['food_id'] . '">';
            echo '<th ';
            if ($currentcate != $row['category_name']) {
                echo 'id="c' . $row['cate_id'] . '"';
                $currentcate = $row['category_name'];
            }
            echo 'scope="row">' . $i . '</th>';
            echo '<td> ' . $row['name'] . '</td>';
            echo '<td>' . $row['category_name'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '</tr>';
            echo '
            <div class="modal fade" id="exampleModal' . $row['food_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel' . $row['food_id'] . '" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel' . $row['food_id'] . '">Food Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body container">';
            // //=======================below is the body of modal===============================
            echo '
            <form action="" method="POST" id="form' . $row['food_id'] . '" enctype="multipart/form-data">
            <div class="row">

                <div class="col-2">

                    <span>Order ID: </span>
                    <br><br>
                    <span>Name : </span>
                    <br><br>
                    <span>Category: </span>
                    <br><br>
                    <span>Price: </span>
                    <br><br>
                    <span>Description: </span>
                </div>

                <div class="col-5 fooddetails">
                    <input type="hidden" name="cate_id" value="' . $row["cate_id"] . '" readonly>

                    <input type="text" name="food_id" value="' . $row["food_id"] . '" readonly>
                    <br><br>
                    <input type="text" name="food_name" value="' . $row["name"] . '" required>
                    <br><br>
                    <input list="cate" name="category" value="' . $row["category_name"] . '" required>
                        <datalist id="cate">';
            insertcatelist();
            echo '</datalist>
                    <br><br>
                    <input type="number" step="0.01"name="food_price" value="' . $row["price"] . '" required>  
                    <br><br>
                    <textarea name="food_desc" required>' . trim($row[3]) . '</textarea>
                </div>

                <div class="col-5">

                    <span>Picture: </span>
                    <div class="foodimgcontainer row">
                        <div class="col">
                            <img id="img' . $row['food_id'] . '"class="foodimg"  style="max-width:300px; max-height:200px"src="data:image/jpeg;base64,' . base64_encode($row['picture']) . '" alt="food">
                            <br>
                                <input name="foodimg" class="hidden" id="uploadimg' . $row['food_id'] . '" type="file" onchange=\'readURL(this,"img' . $row['food_id'] . '");\' />
                            <label for="uploadimg' . $row['food_id'] . '" class="uploadbutton">Select file</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        </div>
                    </div>
                    ';

            echo '    
                <br><br>   
                </div>  
            </div>
            ';

            // ======================end of modal body===========================================
            echo '      </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" onclick="resetc(' . $row['food_id'] . ')" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="deleteitem(' . $row['food_id'] . ')">Delete</button>
                            <button id="resetbutton' . $row['food_id'] . '" type="reset" class="btn btn-success" onclick="resetimg(' . $row["food_id"] . ')">Reset</button>
                            <button type="submit" id="' . $row['food_id'] . '"class="btn btn-primary float-right" onclick="return validateform(this)">Update</button>

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

//to display category at the navigation/directory bar
function displaycate()
{
    $sql = "SELECT DISTINCT(fc.category_name), fc.cate_id FROM `food` fd, `food_category` fc 
    WHERE fd.cate_id = fc.cate_id
    ORDER BY fc.category_name;  ";
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        echo '<script>alert("Sorrt something went wrong D:");
                  </script>';
    } else {
        $i = 0;
        $num_of_cate = mysqli_num_rows($result);
        while ($row = mysqli_fetch_array($result)) {
            echo '<li class="nav-item">
                        <a href="#c' . $row['cate_id'] . '" class="nav-link active">' . $row['category_name'] . '</a>
                    </li>';

            if ($i != ($num_of_cate - 1)) {
                echo '<span> | </span>';
            }
            $i++;
        };
    }
}

//to insert the category list inside modal
function insertcatelist()
{

    $sql = "SELECT * FROM `food_category`
    ";
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        echo '<script>alert("Sorry, something went wrong! caller:insert cate list");
                </script>';
    } else {
        while ($row = mysqli_fetch_array($result)) {
            echo ' <option value="' . $row['category_name'] . '" ';

            echo '>' . $row['category_name'] . '</option>';
        }
    };
}

//to reset the img in menu detail when reset button is clicked
function resetimg($food_id)
{
    $sql = "SELECT * FROM `food` fd WHERE fd.food_id = \"$food_id\"";
    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        echo '<script>alert("Sorry, something went wrong! caller:insert cate list");
                </script>';
    } else {
        while ($row = mysqli_fetch_array($result)) {
            echo 'data:image/jpeg;base64,' . base64_encode($row['picture']);
        }
    };
}

//to delete food when delete button is clicked
function deletefood($food_id)
{
    $id = intval($food_id);
    $sql = "DELETE FROM `food` WHERE food_id=$id";
    include('conn.php');
    if (!mysqli_query($con, $sql)) {
        die('Error:' . mysqli_error($con));
    } else {
        echo '<script>alert("The food is deleted successfully!");
        window.location.href="admin_viewmenu.php";</script>';
    }
    mysqli_close($con);
}

//to update the food upon click
function updatefood()
{
    include("connpdo.php");

    $food_id = $_POST['food_id'];
    $food_name = $_POST['food_name'];
    $cate_name = $_POST['category'];
    $description = $_POST['food_desc'];
    $price = $_POST['food_price'];
    //check if cate exist, if not create new category, and return cate_id
    // $cate_id = getcateid($cate_name);
    $cate_id = getcateid($cate_name);
    if ($_FILES['foodimg']['name'] != "") {
        //check validation for file type
        imagevalidation($_FILES['foodimg']);
        //set the $picture
        $picture = file_get_contents($_FILES['foodimg']['tmp_name']);
        //set sql
        // echo "<script>alert('this is a image file :D')</script>"; //for testing purpose
        $sql = "UPDATE `food` SET
        name = :name,
        cate_id= :cate_id,
        description=:description,
        picture=:picture,
        price=:price
        WHERE food_id=:food_id;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $food_name);
        $stmt->bindParam(':cate_id', $cate_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':food_id', $food_id);
    } else { //else no need to change picture, set sql
        $sql = "UPDATE `food` SET
        name = :name,
        cate_id= :cate_id,
        description=:description,
        price=:price
        WHERE food_id=:food_id;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $food_name);
        $stmt->bindParam(':cate_id', $cate_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':food_id', $food_id);
    }



    if ($stmt->execute()) {
        echo '<script>alert("Successfully updated!");
        window.location.href = "admin_viewmenu.php"</script>';
    }
}

//to check if the category is existed
function getcateid($cate)
{
    include("conn.php");
    $sql = "SELECT * FROM `food_category` WHERE category_name = '" . $cate . "'";
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        createnewcate($cate);
        return getnewcateid($cate);
    } else {
        $row = mysqli_fetch_array($result);
        return $row['cate_id'];
    };
}

//to create new category in db
function createnewcate($cate)
{
    include("conn.php");
    $sql = "INSERT INTO `food_category`(category_name)
	VALUES('$cate')";
    if (!mysqli_query($con, $sql)) {
        mysqli_close($con);
        die('Error:' . mysqli_error($con));
    } else {
        mysqli_close($con);
    }
}

function getnewcateid($cate)
{
    include("conn.php");
    $sql = "SELECT * FROM `food_category` WHERE category_name = '" . $cate . "'";
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        die('Error:' . mysqli_error($con));
    } else {
        $row = mysqli_fetch_array($result);
        return $row['cate_id'];
    };
}




function imagevalidation($file)
{
    // Get Image Dimension
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );

    // Get image file extension
    $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_image_extension)) {
        echo '<script>alert("Sorry, please select a valid image!")</script>';
        return false;
    } else {
        return true;
    }
}

function insertfood()
{
    include("connpdo.php");
    $food_name = $_POST['newfood_name'];
    $cate_name = $_POST['newcategory'];
    $description = $_POST['newfood_desc'];
    $price = $_POST['newfood_price'];
    //check if cate exist, if not create new category, and return cate_id
    $cate_id = getcateid($cate_name);

    if ($_FILES['newfoodimg']['name'] != "") {
        //check validation for file type
        imagevalidation($_FILES['newfoodimg']);
        //set the $picture
        $picture = file_get_contents($_FILES['newfoodimg']['tmp_name']);
        //set sql

    } else { //else no need to change picture, set sql
        $picture = file_get_contents("img/default.jpg");
    }
    $sql = "INSERT INTO `food` (`name`, `cate_id`, `description`, `picture`, `price`, `option`) VALUES (:name, :cate_id, :description, :picture, :price, '');
        ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $food_name);
    $stmt->bindParam(':cate_id', $cate_id);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':picture', $picture);
    if ($stmt->execute()) {
        echo '<script>alert("Successfully created a new food!");
        window.location.href = "admin_viewmenu.php"</script>';
    }
}
