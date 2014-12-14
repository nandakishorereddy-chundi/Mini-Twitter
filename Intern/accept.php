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
	$friend=$_GET['friend'];
	$query1="INSERT INTO `friends`(`username`, `friend`) VALUES ('$username','$friend')";
	$query2="INSERT INTO `friends`(`username`, `friend`) VALUES ('$friend','$username')";
	$query_run1=mysql_query($query1);
	$query_run2=mysql_query($query2);
	if($query_run1 && $query_run2)
	{
		// After adding in `friends` table we delete from `request_pending` table
		$query="DELETE FROM `request_pending` WHERE `username`='$friend' AND `friend`='$username'";
		$query_run=mysql_query($query);
		if($query_run)
		{
			header("Location: friends.php?name=$username");
		}
	}
	else
	{
		echo '<script type="text/javascript">';
		echo 'alert("Failed to add :(");';
		echo "window.location.href = 'friends.php?name=$username';";
		echo '</script>';
	}
?>
