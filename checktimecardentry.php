<?php
session_start();
$host="localhost"; // Host name
$username="crisadmin"; // Mysql username
$password="cris"; // Mysql password
$db_name="cris_data"; // Database name
$tbl_name="cris_users"; // Table name
$timecard_table='cris_work_segments';
// Connect to server and select databse.
$conn = new mysqli($host, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Get user name, email, id from session
$myid = $_SESSION['user_id'];
$myemail = $_SESSION['user_email'];
$myname = $_SESSION['user_name'];
// To protect MySQL injection (more detail about MySQL injection)
$myemail = stripslashes($myemail);
$myname = stripslashes($myname);
$myid = stripslashes($myid);
$myemail = $conn->escape_string($myemail);
$myname = $conn->escape_string($myname);
$myid = $conn->escape_string($myid);
// Look up user info in db
$sql="SELECT * FROM $timecard_table WHERE user_email='$myemail' and user_password='$mypassword'";
$result=$conn->query($sql);

// Mysql_num_row is counting table row
$count=$result->num_rows;
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	// Get associated data from row
	$row_data = $result->fetch_assoc();
	// Set user session information
	$_SESSION['user_email'] = $row_data['user_email'];
	$_SESSION['user_name'] = $row_data['user_name'];
	$_SESSION['user_role'] = $row_data['user_role'];

	// Send user to their dashboard
	header("location:dashboard.php");
}
else {
	// Send user back to login page, set message to wrong credentials
	$_SESSION['message'] = "Wrong Username or Password.";
	header("location:index.php");
}
?>