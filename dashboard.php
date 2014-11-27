<?php
session_start();
if( isset($_POST['name']) ){
  $_SESSION['user_name'] = $_POST['name'];
  $_SESSION['user_role'] = $_POST['position'];
}
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <title><?php echo ucfirst($_SESSION['user_role'])?> Admin: Dashboard</title>
</head>
<body>
<p><b>You are logged in as <?php echo $_SESSION['user_name']?></b></p>
<p><b>You have <?php echo $_SESSION['user_role']?> access</b></p>
<ul>
  <li><a href="entertimecard.php">Enter Weekly Timecard</a></li>
  <?php if($_SESSION['user_role'] == 'owner'){
      echo '<li><a href=\'companypayroll.php\'>Approve Company Payroll</a></li>';
    }?>
</body>
</html>