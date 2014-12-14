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
$query="DELETE FROM `request_pending` WHERE `username`='$friend' AND `friend`='$username'";
$query_run=mysql_query($query);
if($query_run)
{
	header("Location: friends.php?name=$username");
}
else
{
	echo '<script type="text/javascript">';
	echo 'alert("Failed to delete :(");';
	echo "window.location.href = 'friends.php?name=$username';";
	echo '</script>';
}
?>
