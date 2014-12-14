<!DOCTYPE html>
<?php
$nameErr = "";
$passErr = "";
$emailErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	include('connect.php');
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$username=stripslashes($username);
	$email=stripslashes($email);
	$password=stripslashes($password);
	if(empty($username))
	{
		$nameErr = "Name is required";
	}
	if(empty($password))
	{
		$passErr = "Password is required";
	}
	if(empty($email))
	{
		$emailErr = "Email is required";
	}
	else
	{
		$password=md5($password);
		$query="INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";
		$query_run=mysql_query($query);
		if($query_run)
		{
			session_start();
			$_SESSION['sid']=$username;
			$newURL="profile.php?name=$username";
			header('Location: '.$newURL);
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'alert("Username Already exists choose different username :(");';
			echo 'window.location.href = "register.php";';
			echo '</script>';
		}
	}
}
?>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Register</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/index.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="text-center">Register</h1>
				</div>
				<div class="modal-body">
					<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" class="form col-md-12 center-block"  >
						<div class="form-group">
							<input type="text" class="form-control input-lg" placeholder="User Name" name="username"><span><?php echo $nameErr;?></span>
						</div>
						<div class="form-group">
							<input type="email" class="form-control input-lg" placeholder="Email" name="email"><span><?php echo $emailErr;?></span> 
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" placeholder="Password" name="password"><span><?php echo $passErr;?></span> 
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-lg btn-block">Register</button>
							<span class="pull-right"><a href="changepassword.php">Change Password</a></span><span><a href="login.php">Login</a></span>
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
