<?php

#connect to the database
$link = mysqli_connect("localhost", "root", "samael", "psdsv");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$username = mysqli_real_escape_string($link, $_REQUEST['usernameField']);
$email = mysqli_real_escape_string($link, $_REQUEST['emailField']);
$password = mysqli_real_escape_string($link, $_REQUEST['passwordField']);
$name = mysqli_real_escape_string($link, $_REQUEST['nameField']);
$surname = mysqli_real_escape_string($link, $_REQUEST['surnameField']);
$role = mysqli_real_escape_string($link, $_REQUEST['roleField']);
$department = mysqli_real_escape_string($link, $_REQUEST['departmentField']);
 
// Attempt insert query execution
$sql = "INSERT INTO `users`(`username`, `email`, `password`, `name`, `surname`, `role`, `department`) 
VALUES ('$username', '$email', '$password', '$name', '$surname', '$role', '$department')";

if(mysqli_query($link, $sql)){
    header("location: newpublication.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>