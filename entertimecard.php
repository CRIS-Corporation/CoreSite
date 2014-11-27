<?php
session_start();

?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <title><?php echo ucfirst($_SESSION['user_role'])?> Admin: Enter Timecard</title>
</head>
<body>
	<div id="navigation">
		<p><b>You are logged in as <?php echo $_SESSION['user_name']?></b></p>
		<p><b>You have <?php echo $_SESSION['user_role']?> access</b></p>
		<ul>
	  		<li><a href="entertimecard.php">Enter Weekly Timecard</a></li>
	  			<?php if($_SESSION['user_role'] == 'owner'){
	      			echo '<li><a href=\'companypayroll.php\'>Approve Company Payroll</a></li>';
	    		}?>
	    	</li>
	    </ul>
	</div>
	<div id="entryForm">
		<form action="Dashboard.php" method="POST">
			Name: <input type="text" name="name"><br>
			Position: <input type="radio" name="position" value="employee">Employee
			<input type="radio" name="position" value="supervisor">Supervisor
			<input type="radio" name="position" value="owner">Owner<br>
			<input type="submit">
		</form>
	<div>
</body>
</html>