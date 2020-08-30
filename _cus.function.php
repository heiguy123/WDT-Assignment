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

// Update cart number
function numCart($cus_id) {
    include('conn.php');

    $sql =  "SELECT SUM(quantity) FROM `cart_detail` WHERE `cart_id` = 
            (SELECT `cart_id` FROM `cart` WHERE `cus_id` = $cus_id)";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_array($result);
        return $row[0];
    }
}

// Fetch card details into cart page
$cart_detail = array();
$num = 0;
$food_item = array();
$delivery_fee = 5;
$service_tax = 0.06;
$subtotal = 0;
$total = 0;
$cart_result = '';
$food_result = '';

function getcartdetail() {
    include_once('conn.php');
    // Get food item
    $cus_name = $_SESSION['cus_row']['username'];
    
    $sql =  "SELECT * FROM `cart_detail` WHERE `cart_id` = 
            (SELECT `cart_id` FROM `cart` WHERE `cus_id` = 
            (SELECT `cus_id` FROM `customer` WHERE `username` = '$cus_name'))";
    $result = mysqli_query($con,$sql);
    global $num;
    if (mysqli_num_rows($result) > 0) {  
        $num = mysqli_num_rows($result);                                          
        global $cart_detail;
        foreach ($result as $row) {
            $cart_detail[] = array($row['food_id'],$row['quantity'],$row['remark'],$row['subtotal'],$row['cartdetail_id']);
        }
    } else {
        $cart_detail = array();
    }

    if (!empty($cart_detail)) // if there is cart detail
    {
        for ($i=0;$i<=$num-1;$i++) {
            $food_id = $cart_detail[$i][0];
            $sql = "SELECT * FROM `food` WHERE `food_id` = '$food_id'";
            $result = mysqli_query($con,$sql);
            if (mysqli_num_rows($result) == 1) {
                global $food_item;
                header("Content-type: jpeg");
                foreach ($result as $row) {
                    $food_item[] = array($row['name'],$row['description'],$row['price'],
                    '<img class="img-reposnsive" style="max-height: 80px;" src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'"/>');
                }
            }
        }
        // Calculation
        global $delivery_fee;
        global $service_tax;
        global $subtotal;
        global $total;

        // get subtotal from cart
        for ($i=0;$i<=$num-1;$i++) {
            $subtotal += $cart_detail[$i][3];
        }
        
        if ($subtotal >= 30) {
            $delivery_fee = 0;
        }

        $service_tax *= ($subtotal + $delivery_fee);

        $total = $subtotal + $delivery_fee + $service_tax;
        
    } else {  // cart is empty
        global $delivery_fee;
        global $service_tax;
        global $subtotal;
        global $total;

        $delivery_fee = 0;
        $service_tax = 0;
        $subtotal = 0;
        $total = 0;
    }

    global $cart_result;

    if ($num > 0)
    {
        for ($i=0;$i<=$num-1;$i++) 
        {        
            $cart_result .=  '
            <form action="cart.php" method="post">
            <div class="row">
                <input type="hidden" name="cartdetail_id" value="'.$cart_detail[$i][4].'">
                <div class="col-12 col-md-2 text-center image">
                    '.$food_item[$i][3].'
                </div>
                <div class="col-12 text-md-left col-md-4">
                    <h4 class="product-name"><strong>'.$food_item[$i][0].'</strong></h4>
                    <h4>
                        <small>'.$food_item[$i][1].'</small>
                    </h4>
                </div>
                <div class="right col-12 col-md-6 text-md-right row">
                    <div class="price col-3 col-sm-3 col-md-4 text-md-right" style="padding-top: 5px">
                        <h6><strong>'.$food_item[$i][2].' <span class="text-muted">x</span></strong></h6>
                    </div>
                    <div class="number col-4 col-md-2">
                        <div class="quantity">
                            <input name="food_quantity" type="number" step="1" max="99" min="1" value="'.$cart_detail[$i][1].'" title="Qty" class="qty"
                                    size="4">
                        </div>
                    </div>
                    <div class="delete col-2 col-md-2 text-right">
                        <button name="delete" type="submit" class="btn btn-outline-danger btn-xs">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="col-2 col-md-4 text-center update">
                        <button  name="update" type="submit" class="btn btn-outline-info btn-sm">
                            Update Cart
                        </button>
                    </div>
                </div>
            </div>
            </form>
            <hr>
            ';
        }
    }
    

    mysqli_close($con);
}

// Fetch food list into dashboard
$category_name = array();
$food_list = array();
$food_result = '';
$directory = '';

function getfoodlist() {
    include_once('conn.php');

    // Category Name
    $sql = "SELECT `cate_id`,`description` FROM `food_category`";                  
    $result = mysqli_query($con,$sql);                                             
    $num_of_cate = mysqli_num_rows($result);                                         
    if (mysqli_num_rows($result) > 0) {                                            
        global $category_name;
        foreach ($result as $row) {
            $category_name[] = array($row['cate_id'],$row['description']);
        }
    }

    // After getting num_of_cate insert food_item one by one
    global $directory;

    for ($i=0;$i<=$num_of_cate-1;$i++) 
    {   
        $directory .= '
            <li class="nav-item">
                <a href="#link'.$category_name[$i][0].'" class="nav-link active">'.$category_name[$i][1].'</a>
            </li>
        ';

        if($i != $num_of_cate-1){ 
            $directory .= '
            <span> | </span>
            ';  
        }
    }

    // After getting num_of_cate insert food_item one by one
    global $food_result;
    
    for ($i=0;$i<=$num_of_cate-1;$i++) 
    {   
        $food_result .= '
        <br>
        <!-- Section -->
        <a name="link'.($i+1).'"></a>
        <div class="section-title">
            <h2>'.$category_name[$i][1].'</h2>
        </div>
        
        <!-- products -->
        <div class="row padding" id="card">
        ';
        
        // get food based on cate
        $sql = "SELECT * FROM `food` WHERE `cate_id` = ($i+1)";
        $result = mysqli_query($con,$sql);
        $num_of_food = mysqli_num_rows($result);

        global $food_list;

        if (mysqli_num_rows($result) > 0) { // if there is food under this cate, 
            
            header("Content-type: jpeg");
            foreach ($result as $row) {
                $food_list[] = array($row['food_id'],$i,$row['name'],$row['price'],
                '<img class="card-img-top product-image" style="max-height: 130px;" src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'"/>');
            }

            for ($j=0;$j<=$num_of_food-1;$j++) {
                
                $food_result .= '
                <!-- single product -->
                <div class="products-center col-2">
                    <form action="dashboard.php" method="POST">
                        <input type="hidden" name="food_id" value="'.$food_list[$j][0].'">
                        <div class="card">
                            '.$food_list[$j][4].'
                            <div class="card-body">
                                <h6 class="card-title col-12">'.$food_list[$j][2].'</h6>
                                <div class="row">
                                    <p class="card-text product-price col-8">Start from RM'.$food_list[$j][3].'</p>
                                    <button name="add" type="submit" class="btn col-2" text-right><i class="fas fa-plus-square"></i></button>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
                ';
            }

            $food_result .= '
            </div>
            '; 
            
            // Reset array
            $food_list = array();
        }
    }

    mysqli_close($con);
}

// category
// Array(  [0] => Array (  [0] => 1
//                         [1] => Noodle )
//         [1] => Array (  [0] => 2
//                         [1] => Rice )
//         [2] => Array (  [0] => 3
//                         [1] => Soup ))

// food list
// Array ( [0] => Array (  [0] => 1 // food_id
//                         [1] => 1 // cate_id
//                         [2] => Curry Beef Udon
//                         [3] => 10.50
//                         [4] => img
//         [1] => Array (  [0] => 1
//                         [1] => 1
//                         [2] => Curry Beef Udon
//                         [3] => 10.50
//                         [4] => img

// postcode validation
function extract_numbers($string) {
   return preg_match_all('/(?<!\d)\d{5}(?!\d)/', $string, $match) ? $match[0] : [];
}

// Search address
function searchAdd($address) {
    $postcode_arr = extract_numbers($address);
    if (!empty($postcode_arr)) {
        // there is valid postcode
        $add_arr = explode(",",$address);
        $num_of_arr = count($add_arr);
        $postcode = '';
        $street_name = '';
        $city = '';

        for ($i=0;$i<=$num_of_arr-1;$i++) {
            if ($postcode_arr[0] == $add_arr[$i]) 
            {
                // here is the postcode
                $postcode = $add_arr[$i];
                // remove last coma from the streetname
                $street_name = rtrim($street_name, ",");
                $city = $add_arr[($i+1)];
                break;
            } 

            else 
            {
                $street_name .= $add_arr[$i].',';
            }
        }
        
    } else{
        header("Location:dashboard.php?add=undefinedpostcode");
    }

    // check whether city got or not
    if (empty($city)) {
        header("Location:dashboard.php?add=undefinedcity");
    } else {
        // clear session 
        unset($_SESSION['cus_row']['street_name']);
        unset($_SESSION['cus_row']['city']);
        unset($_SESSION['cus_row']['postcode']);
        // store info in session
        $_SESSION['cus_row']['street_name'] = $street_name;
        $_SESSION['cus_row']['city'] = $city;
        $_SESSION['cus_row']['postcode'] = $postcode;
        header("Location:dashboard.php?address=".$address);
    }
}

// Array
// (
//     [0] => lot1206
//     [1] => jalan pujut4
//     [2] =>  98000
//     [3] =>  miri
//     [4] =>  sarawak
//     [5] =>  malaysia
// )

// Modal block address
function blockAdd($address) {
    if (!empty($address)) {
        return TRUE;
    } else {
        // no add in session
        header("Location:dashboard.php?add=block");
        return FALSE;
    }
}

// Add cart
function addCart($food_id) {
    include('conn.php');

    $cus_id = $_SESSION['cus_row']['cus_id'];
    $username = $_SESSION['cus_row']['username'];
    $price = 0;
    $cart_id = 0;

    $sql = "SELECT `cart_id` FROM `cart` WHERE `cus_id` = $cus_id";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_array($result);
        $cart_id = $row[0];
    }

    $sql = "SELECT `price` FROM `food` WHERE `food_id` = $food_id";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_array($result);
        $price = $row[0];
    }

    // Check whether food exist in cart
    $sql = "SELECT SUM(quantity) FROM `cart_detail` WHERE `food_id` = $food_id AND `cart_id` = $cart_id";

    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    if (!empty($row[0])) // perform update quantity
    {
        $quantity = $row[0] + 1;
        $price *= $quantity;

        $sql = "UPDATE `cart_detail` SET `quantity` = $quantity, `subtotal` = $price WHERE `food_id` = $food_id";

        if (mysqli_query($con,$sql)) {
            mysqli_close($con);
            echo '<script>
            window.location.href="dashboard.php";</script>';
        } else{
            mysqli_close($con);
            echo '<script>alert("Added failed.");
            window.location.href="dashboard.php";</script>';
        }


    } else { // perform insert new item

        $sql =  "INSERT INTO `cart_detail`
            
            (`cart_id`, `food_id`, `quantity`,`subtotal`)
            
             VALUES 
             
             ($cart_id, $food_id, 1 , $price)";

        if (mysqli_query($con,$sql)) {
            mysqli_close($con);
            echo '<script>
            window.location.href="dashboard.php";</script>';
        } else{
            mysqli_close($con);
            echo '<script>alert("Added failed.");
            window.location.href="dashboard.php";</script>';
        }
    }
}

// Update cart 
function updateCart($cartdetail_id,$quantity) {
    include('conn.php');

    $sql = "SELECT `price` FROM `food` WHERE `food_id` =
    (SELECT `food_id` FROM `cart_detail` WHERE `cartdetail_id` = $cartdetail_id)";

    $result = (mysqli_query($con,$sql)); 
    if (mysqli_num_rows($result) == 1) {
        foreach ($result as $row) {
            $food_price = $row['price'];
        }
    }

    $food_price *= $quantity;
    
    // Update cart detail table
    $sql = "UPDATE `cart_detail` SET `quantity` = $quantity, `subtotal` = $food_price WHERE `cartdetail_id` = $cartdetail_id";

    if (!mysqli_query($con,$sql)) {
        mysqli_close($con);
        echo '<script>alert("Update failed.");
        </script>';
    }

    // Update cart table
    $cus_name = $_SESSION['cus_row']['username'];
    $cus_id = 0;
    $total_price = 0;

    $sql = "SELECT * FROM `customer` WHERE `username` = '$cus_name'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_array($result);
        $cus_id = $row[0];
    }

    $sql = "SELECT a.subtotal FROM cart_detail a,cart b,customer c 
            WHERE a.cart_id = b.cart_id AND
            b.cus_id = c.cus_id AND
            c.username = '$cus_name';";

    $result = mysqli_query($con,$sql);
    foreach ($result as $row) {
        $total_price += $row['subtotal'];
    }

    $sql = "UPDATE `cart` SET `total` = $total_price WHERE `cus_id` = $cus_id";

    if (mysqli_query($con,$sql)) {
        mysqli_close($con);
        echo '<script>alert("The item has been updated.");
        window.location.href="cart.php";</script>';
    } else{
        mysqli_close($con);
        echo '<script>alert("Update failed. type=1");
        window.location.href="cart.php";</script>';
    }
}

// Delete Cart
function deleteCart($cartdetail_id) {
    $cus_name = $_SESSION['cus_row']['username'];
    $cus_id = 0;
    $total_price = 0;

    include('conn.php');

    $sql = "SELECT * FROM `customer` WHERE `username` = '$cus_name'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_array($result);
        $cus_id = $row[0];
    }

    $sql = "DELETE FROM `cart_detail` WHERE `cartdetail_id` = $cartdetail_id";

    if (!mysqli_query($con,$sql)) {
        mysqli_close($con);
        echo '<script>alert("Remove failed.");
        </script>';
    }

    $sql = "SELECT a.subtotal FROM cart_detail a,cart b,customer c 
            WHERE a.cart_id = b.cart_id AND
            b.cus_id = c.cus_id AND
            c.username = '$cus_name';";

    $result = mysqli_query($con,$sql);
    foreach ($result as $row) {
        $total_price += $row['subtotal'];
    }

    $sql = "UPDATE `cart` SET `total` = $total_price WHERE `cus_id` = $cus_id";

    if (mysqli_query($con,$sql)) {
        mysqli_close($con);
        echo '<script>alert("The item has been removed.");
        window.location.href="cart.php";</script>';
    } else{
        mysqli_close($con);
        echo '<script>alert("Remove failed. type=1(Cart)");
        window.location.href="cart.php";</script>';
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
?>
