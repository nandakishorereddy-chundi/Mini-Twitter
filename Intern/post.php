<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	include('connect.php');
	$username=$_GET['name'];
	$tweet=$_POST['tweet'];
	$tweet=stripslashes($tweet);
	$query="INSERT INTO `tweets`(`username`, `tweet`) VALUES ('$username','$tweet')";
	$query_run=mysql_query($query);
	if($query_run)
	{
		echo '<script type="text/javascript">';
		echo 'alert("Tweet posted :)");';
		echo "window.location.href = 'profile.php?name=$username';";
		echo '</script>';
	}
	else
	{
		echo '<script type="text/javascript">';
		echo 'alert("Failed to add :(");';
		echo "window.location.href = 'profile.php?name=$username';";
		echo '</script>';
	}
}
?>
