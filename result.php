<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Css -->
    <link rel="stylesheet" href="Course/style.css">
    <link rel="icon" href="Icons/ural.jpeg" type="image/gif" sizes="16x16">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <title>Learn with Elearn</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-danger" href="index.php"><b>Elearn</br></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link active" href="result.php">Result</a>
                    <a class="nav-link" href="certificate.php">Certificate</a>
                    <a class="nav-link" href="about.php">About</a>
                </div>
                <div class="nav-item dropdown text white">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-fluid" style="width: 40px;" src="Course/images/Profile.png" alt="PP">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <hr>
                        <li>
                            <h5 class="text-center text-left"><b><?php echo htmlspecialchars($_SESSION["phone"]); ?></b></h5>
                        </li>
                        <hr class="text-white">
                        <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                        <li><a class="dropdown-item" href="reset-password.php">Reset Password</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar -->


    <?php
    include "config.php"; // Using database connection file here
    $ph = $_SESSION['phone'];
    $nm = mysqli_query($link, "SELECT name FROM users WHERE phone = '$ph'"); // fetch data from database
    $nm2 = mysqli_fetch_array($nm);
    ?>
    <div class="mx-auto text-center mt-3">
        <h1 class="text-danger"><span class="text-success mt-3"><b>Result of</b></span> <?php echo $nm2['name']; ?></h1>
    </div>

    <table class="table table-striped" align="center">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Mid</th>
            <th>Final</th>
        </tr>

        <?php
        $ph = $_SESSION['phone'];


        $records = mysqli_query($link, "SELECT * FROM result WHERE phone = '$ph'"); // fetch data from database
        $nm = mysqli_query($link, "SELECT name FROM users WHERE phone = '$ph'"); // fetch data from database
        $nm2 = mysqli_fetch_array($nm);

        while ($data = mysqli_fetch_array($records)) {
        ?>
            <tr>
                <td class="text-danger"><?php echo $nm2['name']; ?></td>
                <td><?php echo $data['phone']; ?></td>
                <td><?php echo $data['mid']; ?></td>
                <td><?php echo $data['final']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>


    <Footer>
        <div class="bg-dark py-2">
            <h6 class="text-center text-light mt-2">
                Powered by <span class="text-danger"><b>Meaningless Compiler</b></span>
            </h6>
        </div>
    </Footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->


</body>

</html>