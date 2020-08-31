<?php 
function validatePostcode($postcode) {
    $bool_check = false;

    include('conn.php');

    $sql = "SELECT `postcode` FROM `deliverable_postcode`";
    
    $result = mysqli_query($con,$sql);
    foreach ($result as $row) {
        $post_row = $row['postcode'];

        if ($post_row == $postcode) {
            // my restaurant can deliver this postcode
            $bool_check = true;
            break;
        }
    }

    mysqli_close($con);
    return $bool_check;
}

if (!validatePostcode('10000')) {
    echo 'add fa';
} else {
    echo 'add true';
}


