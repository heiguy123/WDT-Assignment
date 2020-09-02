<?php
include_once('_admin.functionpart2.php');

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
        echo '<span>Opps, no result for the searched item D:</span>';
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


function displayrequest()
{
    searchrequest(0, 0, "");
}

function searchrequest($sort, $order, $searchitem)
{
    if ($searchitem != "history") {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `order_cancel_request` ordc 
        WHERE ord.cus_id = cus.cus_id 
        AND ordc.order_id = ord.order_id 
        AND cus.cus_name LIKE '%" . $searchitem . "%'
        AND (ordc.request_status = 'Pending')";
    } else {
        $sql = "SELECT * FROM `order` ord, `customer` cus, `order_cancel_request` ordc 
        WHERE ord.cus_id = cus.cus_id 
        AND ordc.order_id = ord.order_id
        AND (ordc.request_status = 'Rejected' OR ordc.request_status = 'Accepted')";
    }

    if ($sort == 0 && $order == 0) {
        $sql .= "ORDER BY ord.time";
    } elseif ($sort == 1 && $order == 0) {
        $sql .= "ORDER BY ord.total_cost";
    } elseif ($sort == 0 && $order == 1) {
        $sql .= "ORDER BY ord.time DESC";
    } elseif ($sort == 1 && $order == 1) {
        $sql .= "ORDER BY ord.total_cost DESC";
    }

    include('conn.php');
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        echo '<tr><th scope="row" colspan="6" >There is no pending request.</th></tr>';
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr class="orderrow" data-toggle="modal" data-target="#exampleModal' . $row['request_id'] . '">';
            echo '<th scope="row">' . $i . '</th>';
            echo '<td> ' . $row['request_id'] . '</td>';
            echo '<td>' . $row['cus_name'] . '</td>';
            echo '<td>' . $row['request_status'] . '</td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td>' . $row['total_cost'] . '</td>';
            echo '</tr>';
            echo '
            <div class="modal fade" id="exampleModal' . $row['request_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel' . $row['request_id'] . '" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
    
                    <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel' . $row['request_id'] . '">Request Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body container">';
            //=======================below is the body of modal===============================
            echo '
            <div class="row details">
            
                <div class="col-7">
                    <input type="hidden" name="request_id" value="' . $row["request_id"] . '" readonly>
                    <p>Request ID:' . $row["request_id"] . '</p>
                    <p>Order ID:' . $row["order_id"] . '</p>
                    <p>Name: ' . $row['cus_name'] . '</p>
                    <p>Time: ' . $row['time'] . '</p>    
                </div>
                <div class="col-5">
                    <span>Order Status:   ' . $row['order_status'] . '  </span><br>
                    <span>Request Status:   ' . $row['request_status'] . '  </span>
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
            if ($searchitem != "history") {
                // ======================end of modal body===========================================
                echo '      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" name="reject" onclick="return confirm(\'Are you sure you want to reject the request?\')">Reject</button>
                            <button type="submit" class="btn btn-success float-right" name="accept" onclick="return confirm(\'Are you sure you want to accept the request?\')">Accept</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            ';
            } else {
                echo '      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            ';
            }

            $i++;
        };
    }
}

function updaterequest($i)
{
    if ($i == 0) {
        //rejected
        $status = "Rejected";
    } elseif ($i == 1) {
        //accepted
        $status = "Accepted";
    }
    include("conn.php");
    $sql = "UPDATE `order_cancel_request` SET
            request_status='$status'
            WHERE request_id=" . $_POST['request_id'] . ";";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        echo '<script>alert("Successfully ' . $status . '!");
        window.location.href = "admin_viewrequest.php";
        </script>';
    }
}

function getEncryptedPassword($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function changepassword()
{
    $errarray[] =  array();
    $adminid = $_SESSION['admin_row']['admin_id'];
    $currentPassword = $_POST['cur_password'];
    $newPassword = $_POST['password'];
    $reNewPassword = $_POST['re_password'];
    include("conn.php");
    $sql = "SELECT * FROM `admin` WHERE admin_id = $adminid";
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 0) { //if there is no record
        die('Error:' . mysqli_error($con));
    } else {
        $row = mysqli_fetch_array($result);
        $passhash = $row['password'];
    }
    //check if the password matches
    if (!password_verify($currentPassword, $passhash)) {
        $errarray = array(
            'errtype'  => "cur_pass",
            'msg' => "Wrong Password"
        );
        // echo "<script>alert('Password doesnt match');</script>";
    }

    if ($newPassword != $reNewPassword) {

        $errarray = array(
            'errtype'  => "new_pass",
            'msg' => "Passwords do not match!"
        );
    }

    if (count($errarray) != 1) { //failed
        return $errarray;
    } else {
        updatepassword($adminid, $newPassword);
    }
}

function updatepassword($id, $password)
{
    $password = getEncryptedPassword($password);
    include("conn.php");
    $sql = "UPDATE `admin` SET
        password='$password'
        WHERE admin_id=" . $id . ";";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        echo '<script>alert("Successfully changed!");
        window.location.href = "admin_managepassword.php";
        </script>';
    }
}
