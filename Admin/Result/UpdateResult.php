<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php

include "config.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($link, "SELECT * FROM result WHERE id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if (isset($_POST['update'])) // when click on Update button
{
    $mid = $_POST['mid'];
    $final = $_POST['final'];

    $edit = mysqli_query($link, "UPDATE result SET mid='$mid', final='$final' WHERE id='$id'");

    if ($edit) {
        mysqli_close($link); // Close connection
        header("location:updateresultinfo.php"); // redirects to all records page
        exit;
    } else {
        echo mysqli_error($link);
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Update Result</title>

</head>

<body class="bg-dark">



    <div class="text-center text-white">
        <h3>Update Result</h3>
        <h2>Change Result for: <span class="text-success"><?php echo $data['phone'] ?></span></h2>
        <form method="POST">
            <input type="text" name="mid" value="<?php echo $data['mid'] ?>" placeholder="Enter Mid Result" Required>
            <input type="text" name="final" value="<?php echo $data['final'] ?>" placeholder="Enter Final Result" Required>
            <br><input class="btn btn-danger my-3 btnw" type="submit" name="update" value="Update">
        </form>
    </div>

</body>

</html>