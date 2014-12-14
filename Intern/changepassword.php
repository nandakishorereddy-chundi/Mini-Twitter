<!DOCTYPE html>
<?php
$nameErr = "";
$newpassErr = "";
$oldpassErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	include('connect.php');
	$username=$_POST['username'];
	$old_password=$_POST['old_password'];
	$new_password=$_POST['new_password'];
	$username=stripslashes($username);
	$old_password=stripslashes($old_password);
	$new_password=stripslashes($new_password);
	if(empty($username))
	{
		$nameErr = "Name is required";
	}
	if(empty($old_password))
	{
		$oldpassErr = "Old Password is required";
	}
	if(empty($new_password))
	{
		$newpassErr = "New Password is required";
	}
	else
	{
		$old_password=md5($old_password);
		$new_password=md5($new_password);
		$query="SELECT `password` FROM `users` WHERE `username`='$username' ";
		$query_run=mysql_query($query);
		$row=mysql_fetch_assoc($query_run);
		$password=$row['password'];
		if($password==$old_password)
		{
			$query="UPDATE `users` SET `password`='$new_password' WHERE `username`='$username'";
			$query_run=mysql_query($query);
			if($query_run)
			{
				echo '<script type="text/javascript">';
				echo 'alert("Password Updated successfully :)");';
				echo 'window.location.href = "login.php";';
				echo '</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'alert("Failed to Update :(");';
			echo 'window.location.href = "changepassword.php";';
			echo '</script>';
		}
	}
}
?>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Change Password</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/index.min.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
</head>
<body>
	<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="text-center">Change Password</h1>
				</div>
				<div class="modal-body">
					<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" class="form col-md-12 center-block"  >
						<div class="form-group">
							<input type="text" class="form-control input-lg" placeholder="User Name" name="username"><span><?php echo $nameErr;?></span>
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" placeholder="Old Password" name="old_password"><span><?php echo $oldpassErr;?></span> 
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" placeholder="New Password" name="new_password"><span><?php echo $newpassErr;?></span> 
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-lg btn-block">Change Password</button>
							<span class="pull-right"><a href="register.php">Register</a></span><span><a href="login.php">Login</a></span>
						</div>
					</form>
				</div>
				<div class="modal-footer">	
				</div>
			</div>
		</div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="js/index.min.js"></script>
</body>
</html>
