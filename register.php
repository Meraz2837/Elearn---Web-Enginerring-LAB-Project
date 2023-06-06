<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$phone = $password = $confirm_password = "";
$phone_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter a phone.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE phone = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);

            // Set parameters
            $param_phone = trim($_POST["phone"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $phone_err = "This phone is already taken.";
                } else {
                    $phone = trim($_POST["phone"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    $name = trim($_POST["name"]);
    $bplink = trim($_POST["bplink"]);


    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($phone_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (name, phone, password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_phone, $param_password);

            // Set parameters
            $param_name = $name;
            $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
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
    <link rel="icon" href="Icons/ural.jpeg" type="image/gif" sizes="16x16">
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


    <div>
        <img style="width: 100%" class="img-fluid" src="images/Left.gif">
    </div>


    <div class="wrapper mx-auto">
        <h2>Sign up</h2>
        <p>Fill up the form to register</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" required name="name" class="form-control">
                </div>
                <label>Phone</label>
                <input type="tel" name="phone" required class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" required name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" required name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group my-3">
                <input type="submit" class="btn btn-warning" value="সাবমিট">
                <input type="reset" class="btn btn-secondary ml-2" value="রিসেট">
            </div>
            <p>Already have an account? <a href="login.php">Login now</a>.</p>
        </form>
    </div>


    <div>
        <img style="width: 100%" class="img-fluid" src="images/Right.gif">
    </div>


    <Footer>
        <div class="bg-dark py-2">
            <h6 class="text-center text-light mt-2 bg-dark">
                Powered by <span class="text-danger bg-dark">Meaningless Compiler</span>
            </h6>
        </div>
    </Footer>


</body>

</html>