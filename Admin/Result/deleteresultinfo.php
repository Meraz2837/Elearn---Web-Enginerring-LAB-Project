<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Learn with Elearn</title>

</head>

<body class="container">


    <h2 align="center">Remove Results</h2>

    <table align="center" class="table">
        <tr>
            <th>ID</th>
            <th>Phone</th>
            <th>Mid</th>
            <th>Final</th>
            <th>Remove</th>
        </tr>

        <?php

        include "config.php"; // Using database connection file here

        $records = mysqli_query($link, "SELECT * FROM result"); // fetch data from database

        while ($data = mysqli_fetch_array($records)) {
        ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['phone']; ?></td>
                <td><?php echo $data['mid']; ?></td>
                <td><?php echo $data['final']; ?></td>
                <td><a class="btn btn-danger" href="UserResultDelete.php?id=<?php echo $data['id']; ?>">Remove</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <!-- Footer -->
    <!-- Copyright -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>