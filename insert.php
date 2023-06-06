<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "upbdlike54_elearn_reg", "elearn_reg_webio", "upbdlike54_elearn_regDB");

// Check connection
if ($link === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$name= mysqli_real_escape_string($link, $_REQUEST['name']);
$phone = mysqli_real_escape_string($link, $_REQUEST['phone']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);

// Attempt insert query execution
$sql = "INSERT INTO canvapro (name, phone, email) VALUES ('$name', '$phone', '$email')";
if (mysqli_query($link, $sql)) {
  header("location: done.php");
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>