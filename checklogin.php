<?php
$host="localhost"; // Host name
$username="crisadmin"; // Mysql username
$password="cris"; // Mysql password
$db_name="cris_data"; // Database name
$tbl_name="cris_users"; // Table name
// Connect to server and select databse.
$conn = new mysqli($host, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// username and password sent from form
$myemail=$_POST['email'];
$mypassword=$_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
$myemail = stripslashes($myemail);
$mypassword = stripslashes($mypassword);
$myemail = $conn->escape_string($myemail);
$mypassword = $conn->escape_string($mypassword);
// Look up user info in db
$sql="SELECT * FROM $tbl_name WHERE user_email='$myemail' and user_password='$mypassword'";
$result=$conn->query($sql);

// Mysql_num_row is counting table row
$count=$result->num_rows;
// If result matched $myusername and $mypassword, table row must be 1 row
session_start();
if($count==1){
	// Get associated data from row
	$row_data = $result->fetch_assoc();
	// Set user session information
	$_SESSION['user_email'] = $row_data['user_email'];
	$_SESSION['user_name'] = $row_data['user_name'];
	$_SESSION['user_role'] = $row_data['user_role'];
	$_SESSION['user_id'] = $row_data['user_id'];
	// Send user to their dashboard
	header("location:dashboard.php");
}
else {
	// Send user back to login page, set message to wrong credentials
	$_SESSION['message'] = "Wrong Username or Password.";
	header("location:index.php");
}
?>