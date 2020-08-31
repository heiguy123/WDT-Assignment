<?php
    include('_cus.function.php');
    checksession();
    getcartdetail();

    $payment_method = '';
    $cus_id = $_SESSION['cus_row']['cus_id'];
    $add_id = 0;

    if (isset($_POST['card'])) {
        $cus_full_name = $_POST['cus_full_name'];
        $card_num = $_POST['card_num'];
        $MM = $_POST['MM'];
        $YY = $_POST['YY'];
        $CVV = $_POST['CVV'];

        // Do easy vaidation

        // Once done validation
        $payment_method = 'Credit / Debit Card';
    }
    
    if (isset($_POST['online_banking'])) {
        // Do easy vaidation

        // Once done validation
        $payment_method = 'Online Banking';
    }

    if (!empty($payment_method)) {
        // means validation pass, record into database
        // insert data into `payment` through `payment_method`
        include('conn.php');

        $sql = "INSERT INTO `payment`
                
                (`cus_id`,`payment_method`, `paid_amount`, `payment_status`)

                VALUES 
                
                ($cus_id,(SELECT `payment_method` FROM `payment_method` WHERE `payment_method` = '$payment_method'), $total, 'Success')";

        if (mysqli_query($con,$sql)) {
            // success 

            // define address to be used
            if (!empty($_SESSION['cus_row']['street_name'])) { // if user input an address, no matter it is in or not in the database
                // validate whether the address is or not same in the database
                $street_name = $_SESSION['cus_row']['street_name'];
                
                $sql = "SELECT * FROM `user_address` WHERE `address` = '$street_name' AND `cus_id` = $cus_id";

                $result = mysqli_query($con,$sql);
                if (mysqli_num_rows($result) > 0) { // the address cus input is the same in the database
                    // use the address (add_id) in the database then
                    $add_row = mysqli_fetch_array($result);
                    global $add_id;
                    $add_id = $add_row['add_id'];
                } else { // the address cus input is not the same in the database, write new address into database
                    $street_name = $_SESSION['cus_row']['street_name'];
                    $city = $_SESSION['cus_row']['city'];
                    $postcode = $_SESSION['cus_row']['postcode'];

                    $sql = "INSERT INTO `user_address`
                        
                        (`cus_id`,`address`, `city`, `postcode`)

                        VALUES 
                        
                        ($cus_id,'$street_name','$city',$postcode)";

                    if (mysqli_query($con,$sql)) {
                        // get the new add_id
                        $sql = "SELECT `add_id` FROM `user_address` WHERE `address` = '$street_name' AND `cus_id` = $cus_id";
                        if ($result=mysqli_query($con,$sql)) {
                            $add_row = mysqli_fetch_array($result);
                            global $add_id;
                            $add_id = $add_row['add_id'];
                        }
                    }

                }

            } else { // the user doesnt input address, use the latest address (add_id) from the database
                $sql = "SELECT `add_id` FROM `user_address` WHERE `cus_id` = $cus_id ORDER BY `add_id` DESC LIMIT 1";
                if ($result=mysqli_query($con,$sql)) {
                    $add_row = mysqli_fetch_array($result);
                    global $add_id;
                    $add_id = $add_row['add_id'];
                }
            }

            //                                              //
            // now get the 'add_id' , use to insert `order` //
            //                                              //

            // insert data into `order` through `order_status`
            $time = date("Y-m-d H:i:s");

            $sql = "INSERT INTO `order`
                
                (`cus_id`, `delivery_cost`, `food_cost`, `total_cost`, `order_status`, `payment_id`, `time`, `add_id`)

                VALUES 
                
                ($cus_id, $delivery_fee, $subtotal, $total,(SELECT `order_status` FROM `order_status` WHERE `order_status` = 'Confirmed'),
                (SELECT `payment_id` FROM `payment` WHERE `cus_id` = $cus_id ORDER BY `payment_id` DESC LIMIT 1),
                '$time', $add_id)";

            if (mysqli_query($con,$sql)) {
                // success

                // get `order_id` from the order created
                $sql = "SELECT `order_id` FROM `order` WHERE `cus_id` = $cus_id ORDER BY `order_id` DESC LIMIT 1";
                if ($result=mysqli_query($con,$sql)) {
                    $order_row = mysqli_fetch_array($result);
                    $order_id = $order_row['order_id'];
                }

                // get cartdetail from `cart_detail`, then remove item from it once success
                $sql = "SELECT * FROM `cart_detail` WHERE `cart_id` = (SELECT `cart_id` FROM `cart` WHERE `cus_id` = $cus_id)";

                $result=mysqli_query($con,$sql);
                if ($num_of_cart=mysqli_num_rows($result) > 0) { // if there is food item in the cart (At this point there shoull be)
                    foreach ($result as $cart_row) {
                        $food_id = $cart_row['food_id'];
                        $quantity = $cart_row['quantity'];
                        $subtotal = $cart_row['subtotal'];

                        // use for loop to keep inserting cart_detail into order_detail
                        $sql = "INSERT INTO `order_detail`
                
                                (`order_id`, `food_id`, `quantity`, `subtotal`)

                                VALUES 
                                
                                ($order_id, $food_id, $quantity, $subtotal)";
                        
                        if (!mysqli_query($con,$sql)) {
                            break;
                        }
                    }
                }

                // Remove item from `cart_detail`
                $sql = "DELETE FROM `cart_detail` WHERE `cart_id` = (SELECT `cart_id` FROM `cart` WHERE `cus_id` = $cus_id)";
                if (!mysqli_query($con,$sql)) {
                    echo '<script>alert("Payment failed.");</script>';
                }

                mysqli_close($con);
                sendreceipt($_SESSION['cus_row']['email']);
            }

        } else {
            // Failed, but add failed record
            echo '<script>alert("Payment failed.");</script>';
         
            $sql = "INSERT INTO `payment`
                        
                    (`cus_id`,`payment_method`, `paid_amount`, `payment_status`)

                    VALUES 
                    
                    ($cus_id,(SELECT `payment_method` FROM `payment_method` WHERE `payment_method` = 'Credit / Debit Card'), $total, 'Failed')";

            mysqli_query($con,$sql);
            mysqli_close($con);
            echo '<script>window.location.href="payment.php";</script>';
        }
    }
?>