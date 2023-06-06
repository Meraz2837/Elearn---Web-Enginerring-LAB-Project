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
<style>
    .container1 {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 56.25%;
        /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
    }

    /* Then style the iframe to fit in the container div with full height and width */
    .responsive-iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 95%;
        height: 100%;
    }
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Css -->

    <link rel="icon" href="Icons/ural.jpeg" type="image/gif" sizes="16x16">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <title>Learn with Elearn
    </title>
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
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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


    <section>
        <div class="mx-auto text-center">
            <h2 class="my-2"><b>Android</b></h2>
            <h4 class="my-2">Day 1</h4>
        </div>
        <div class="container1 mx-auto text-center mb-2">

            <iframe class="responsive-iframe mx-auto" src="https://www.youtube.com/embed/tRu6FJAWR-E">
            </iframe>
        </div>
        <div class="mx-auto text-center">
            <h4 class="my-2">Day 2</h4>
        </div>
        <div class="container1 mx-auto text-center mb-2">
            <iframe class="responsive-iframe mx-auto" src="https://www.youtube.com/embed/fis26HvvDII">
            </iframe>
        </div>
        <div class="mx-auto text-center">
            <h4 class="my-2">Day 3</h4>
        </div>
        <div class="container1 mx-auto text-center mb-2">
            <iframe class="responsive-iframe mx-auto" src="https://www.youtube.com/embed/Ibx2Ri5Blh0">
            </iframe>
        </div>
        <div class="mx-auto text-center">
            <h4 class="my-2">Day 4</h4>
        </div>
        <div class="container1 mx-auto text-center mb-2">
            <iframe class="responsive-iframe mx-auto" src="https://www.youtube.com/embed/Ibx2Ri5Blh0">
            </iframe>
        </div>
    </section>




    <Footer>
        <div class="bg-dark py-2">
            <h6 class="text-center text-light mt-2">
                Powered by <span class="text-danger"><b>Learn with Elearn</b></span>
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