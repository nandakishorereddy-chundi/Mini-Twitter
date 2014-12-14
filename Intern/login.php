<!DOCTYPE html>
<?php
$nameErr = "";
$passErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	include('connect.php');
	$username=$_POST['username'];
	$password=$_POST['password'];
	$username=stripslashes($username);
	$password=stripslashes($password);
	$query="SELECT `username` FROM users WHERE username='$username'";
	$query_run=mysql_query($query);
	$num=mysql_num_rows($query_run);
	if(empty($username))
	{
		$nameErr = "Name is required";
	}
	if(empty($password))
	{
		$passErr = "Password is required";
	}
	else if($num!=1)
	{
		$nameErr = "Username Dosenot Exist";
	}
	else
	{
		$query="SELECT * FROM users WHERE username='$username'";
		$query_run=mysql_query($query);
		$row=mysql_fetch_assoc($query_run);
		$pass=$row['password'];
		if($pass==md5($password))
		{
			session_start();
			$_SESSION['sid']=$username;
			$newURL="profile.php?name=$username";
			header('Location: '.$newURL);
		}
		else
		{
			$passErr="Password is incorrect";
		}
	}
}
?>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Login</title>
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
					<h1 class="text-center">Login</h1>
				</div>
				<div class="modal-body">
					<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" class="form col-md-12 center-block"  >
						<div class="form-group">
							<input type="text" class="form-control input-lg" placeholder="Email" name="username"><span><?php echo $nameErr;?></span>
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" placeholder="Password" name="password"><span><?php echo $passErr;?></span> 
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-lg btn-block">Sign In</button>
							<span class="pull-right"><a href="changepassword.php">Change Password</a></span><span><a href="register.php">Register</a></span>
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
