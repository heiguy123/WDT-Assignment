<?php
$con = mysqli_connect("localhost", "root", "", "foodordering", "3308");

//check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySql" . mysqli_connect_errno();
} else {
	// echo"<script>alert('Successfully connected to MySql!')</script>";
}
?>