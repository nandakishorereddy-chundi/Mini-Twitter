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
	<title>Profile</title>
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
	</style>
</head>
<body>
	<header class="navbar navbar-bright navbar-fixed-top" role="banner">			
		<div class="button">
			<button type="submit" class="btn btn-default pull-right" onclick="location.href = 'logout.php';">Log Out</button>
			<button type="submit" class="btn btn-default pull-right" onclick="location.href = 'friends.php?name=<?php echo "$username"; ?>';">Friends</button>
		</div>
	</header>


	<div id="masthead">  
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<a href='profile.php?name=<?php echo "$username"; ?>'><h1><?php echo "$username" ?></h1></a>
				</div>
				<div class="col-md-5">
					<div class="well well-lg"> 
						<div class="row">
							<div class="col-sm-12">
								<h3>Post a new up date</h3>
								<form action='post.php?name=<?php echo "$username";?>' method="post">
									<textarea placeholder="Type your status update here" name="tweet" rows="7" cols="50" style="font-family:comic sans ms;color:black;font-size:14px" required></textarea>
									<button type="submit" class="btn btn-default pull-right">POST</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


		<div class="container">
			<div class="row">

				<div class="col-md-12"> 

					<div class="panel">
						<div class="panel-body">
							<div class="row">    
								<br>
								<div  class="col-md-2 col-sm-3 text-center"></div>
								<?php
								echo '<div class="col-md-10 col-sm-9">';
								// Selecting tweets from `tweets` table by searching friends in `friends` table
								$query="SELECT * FROM `tweets` 
								WHERE `username` IN (SELECT `friend` FROM `friends` WHERE `username`='$username')";
								$query_run=mysql_query($query);
								if($query_run)
								{
									echo "<h1> UPDATES </h1> <br><br><br>";
									$cnt=0;
									while($row=mysql_fetch_assoc($query_run))
									{
										$username=$row['username'];
										$tweet=$row['tweet'];
										echo "<h3> Update from $username </h3>";
										echo "<h2> $tweet </h2>";
										echo "<hr>";
										echo "<br><br>";
										$cnt+=1;
										if($cnt==20)
										{
											break;
										}
									}
								}
								echo '</div>';
								?>
								<br><br>
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
