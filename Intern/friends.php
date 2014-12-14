<!DOCTYPE html>
<?php
$username=$_GET['name'];
session_start();
if($_SESSION['sid']!=$username)
{
	echo '<script type="text/javascript">';
	echo 'window.location.href = "login.php";';
	echo '</script>';
}
include('connect.php');
?>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Friends</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/profile.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/profile.css" rel="stylesheet">
	<style type="text/css">
		div.button
		{
			padding: 20px 80px 20px; 
		}
		.left{float:left; width:25%;}
	</style>
</head>
<body>
	<header class="navbar navbar-bright navbar-fixed-top" role="banner">			
		<div class="button">
			<button type="submit" class="btn btn-default pull-right" onclick="location.href = 'login.php';">Log Out</button>
			<button type="submit" class="btn btn-default pull-right" onclick="location.href = 'friends.php?name=<?php echo "$username"; ?>';">Friends</button>
		</div>
	</header>
	

	<div id="masthead">  
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<a href='profile.php?name=<?php echo "$username"; ?>'><h1><?php echo "$username" ?></h1></a>
				</div> 
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<div class="col-md-12"> 

				<div class="panel">
					<div class="panel-body">
						<div class="left" style="font-size: 20px">
							Friend Requests
							<br>
							<?php
							$query="SELECT `username` FROM `request_pending` WHERE `friend`='$username'";
							$query_run=mysql_query($query);
							if($query_run)
							{
								while($row=mysql_fetch_assoc($query_run))
								{
									$friend=$row['username'];
									echo "$friend"."<form action='accept.php?name=$username&friend=$friend' method='post'><input type='submit' value='Accept'></form>".
									"<form action='reject.php?name=$username&friend=$friend' method='post'><input type='submit' value='Reject'></form>";
								}
							}
							?>
						</div>
						<div class="left" style="font-size: 20px">
							Friends
							<br>
							<?php
							$query="SELECT `friend` FROM `friends` WHERE `username`='$username'";
							$query_run=mysql_query($query);
							if($query_run)
							{
								while($row=mysql_fetch_assoc($query_run))
								{
									$friend=$row['friend'];
									echo "$friend"."<br><br>";
								}
							}
							?>
						</div>
						<div class="left" style="font-size: 20px">
							Friend Request Pending
							<br>
							<?php
							$query="SELECT `friend` FROM `request_pending` WHERE `username`='$username'";
							$query_run=mysql_query($query);
							if($query_run)
							{
								while($row=mysql_fetch_assoc($query_run))
								{
									$friend=$row['friend'];
									echo "$friend"."<br>"."<input type='submit' value='request pending....'>";
									echo "<br><br>";
								}
							}
							?>
						</div>
						<div class="left" style="font-size: 20px">
							All Users
							<br>
							<?php
							// Selecting all users from `user` table except friends and pending friend requests and also users who sent friend request to present user
							$query="SELECT `username` FROM `users` WHERE
							`username` NOT IN ( SELECT `friend` FROM `friends` WHERE `username`='$username' UNION 
								SELECT `username` FROM `request_pending` WHERE `friend`='$username' UNION 
								SELECT `friend` FROM `request_pending` WHERE `username`='$username' ) AND `username`!='$username'";
							$query_run=mysql_query($query);
							if($query_run)
							{
								$cnt=0;
								while($row=mysql_fetch_assoc($query_run))
								{
									$user=$row['username'];
									echo "$user"."<form action='addfriend.php?name=$username&friend=$user' method='post'><input type='submit' value='ADD'></form>";
									echo "<br>";
									$cnt+=1;
									if($cnt==20)
									{
										break;
									}
								}
							}
							?>
						</div>
					</div>
					<hr>

					<hr>

				</div>
			</div>



		</div>
	</div>


	<hr>

	<hr>

	<hr>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="js/profile.min.js"></script>
</body>
</html>
