<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$phone = $password = "";
$phone_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if phone is empty
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter phone.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($phone_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, phone, password FROM users WHERE phone = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);

            // Set parameters
            $param_phone = $phone;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if phone exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $phone, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["phone"] = $phone;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid phone or password.";
                        }
                    }
                } else {
                    // phone doesn't exist, display a generic error message
                    $login_err = "Invalid phone or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Css -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <title>Learn with Elearn</title>
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <Navbar>
        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container">
                <a class="navbar-brand text-danger" href="#"><b>Elearn</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto text-center">
                        <li class="nav-item">
                            <a class="nav-link  text-danger" aria-current="page" href="index.php"><b>Home</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="result.php"><b>Result</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="certificate.php"><b>Certificate</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php"><b>About</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </Navbar>

    <div>
        <img style="width: 100%" class="img-fluid" src="images/Left.gif">
    </div>
    <div class="wrapper mx-auto">
        <h2>Login</h2>
        <p>Please fill in your credentials to login</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group my-3">
                <input type="submit" class="btn btn-warning" value="Login">
            </div>
            <p>Doesn't have an account? <a href="register.php">Create an account</a>.</p>
        </form>
    </div>
    <div>
        <img style="width: 100%" class="img-fluid" src="images/Right.gif">
    </div>



    <footer class="bg-warning">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mx-auto my-auto text-sm-center">
                    <h4 class="text-danger mt-2 text-center"><b>Elearn</b></h4>
                </div>
                <div class="col-md-4 my-3 mx-auto text-center">
                    <h5><b>Important Links</b></h5>
                    <hr>
                    <div class="text-center">
                        <a class="text-dark" href="result.php"><b>Result</b></a><br>
                        <a class="text-dark" href="certificate.php"><b>Certificate</b></a><br>
                        <a class="text-dark" href="about.php"><b>About</b></a>
                    </div>
                </div>
                <div class="col-md-4 my-3 mx-auto text-center">
                    <h5><b>Contact</b></h5>
                    <hr>
                    <div class="text-center my-auto">
                        <a class="text-dark" href="tel:+8801796228391"><b>+88 01796-228391</b></a><br>
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