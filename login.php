<?php
session_start();
#connect to the database
$link = mysqli_connect("localhost", "root", "samael", "psdsv");

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$myusername = mysqli_real_escape_string($link, $_REQUEST['usernameField']);
$mypassword = mysqli_real_escape_string($link, $_REQUEST['passwordField']);

$sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";

$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $getUserRow = mysqli_fetch_assoc($result);
	unset($getUserRow['password']);
			
	$_SESSION = $getUserRow;
    header("location: newpublication.php");
} else {
    $error = "Your Login Name or Password is invalid";
}

mysqli_close($link);
