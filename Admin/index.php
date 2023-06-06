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

    <link rel="stylesheet" href="Styles/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Pushster&family=Spline+Sans&display=swap" rel="stylesheet">
    <title>Admin</title>
</head>

<body>
    <Navbar>
        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container">
                <a class="navbar-brand text-danger" href="#"><b>Elearn</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link text-danger" aria-current="page" href="index.php">Home</a>
                        <a class="nav-link" href="result">Result</a>
                        <a class="nav-link" href="certificate">Certificate</a>
                    </div>
                    <div class="nav-item dropdown text white">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-fluid" style="width: 40px;" src="../Course/images/Profile.png" alt="PP">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <hr>
                            <li>
                                <h5 class="text-center text-left"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h5>
                            </li>
                            <hr class="text-white">
                            <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </Navbar>


    <section class="container">
        <hr>
        <div class="row">
            <div class="col-md-6 my-auto mx-auto">
                <h3 class="text-center"><b>Update Result</b></h3>
                <hr style="height: 5px; width: 30px;" class="text-dark text-center mx-auto">
                <h5 style="text-align: justify;">
                    Hello Admin <br>Let's Update The Result
                </h5>
                <div class="text-center">
                    <a class="btn btn-danger" href="Result">Update Result</a>
                </div>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="Images/Icon/2.png" alt="elearn">
            </div>
        </div>
        <hr>
    </section>

    <section class="container">
        <hr>
        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid" src="Images/Icon/1.png" alt="elearn">
            </div>
            <div class="col-md-6 my-auto mx-auto">
                <h3 class="text-center"><b>Update Certificate</b></h3>
                <hr style="height: 5px; width: 30px;" class="text-dark text-center mx-auto">
                <h5 style="text-align: justify;">
                    Hello Admin <br>Let's Provide The Certificate
                </h5>
                <div class="text-center">
                    <a class="btn btn-danger" href="certificate">Update Certificate</a>
                </div>
            </div>
        </div>
        <hr>
    </section>


    <footer class="bg-warning">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mx-auto my-auto text-sm-center">
                    <h4 class="text-danger mt-2 text-center"><b>Admin</b></h4>
                </div>

                <div class="col-md-4 my-3 mx-auto text-center">
                    <h5><b>Important Links</b></h5>
                    <hr>
                    <div class="text-center">
                        <a class="text-dark" href="index.php"><b>Home</b></a><br>
                        <a class="text-dark" href="result"><b>Result</b></a><br>
                        <a class="text-dark" href="certificate"><b>Certificate</b></a>
                    </div>
                </div>
                <div class="col-md-4 my-3 mx-auto text-center">
                    <h5><b>Contact</b></h5>
                    <hr>
                    <div class="text-center my-auto">
                        <a class="text-dark" href="tel:+8801796228391"><b>+8801796228391</b></a><br>
                        <a class="text-dark" href="mailto:meaninglesscompiler@gmail.com"><b>meaninglesscompiler@gmail.com</b></a><br>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <Footer>
        <div class="bg-dark py-2">
            <h6 class="text-center text-light mt-2 bg-dark">
                Powered by <span class="text-danger bg-dark">Meaningless Compiler</span>
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