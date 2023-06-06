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
require '../../config.php';
if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  if ($_FILES["image"]["error"] == 4) {
    echo
    "<script> alert('Image Does Not Exist'); </script>";
  } else {
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    } else if ($fileSize > 1000000) {
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    } else {
      $newImageName = $name;
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'certificates/' . $newImageName);
      $query = "INSERT INTO certificate VALUES('', '$name', '$newImageName')";
      mysqli_query($link, $query);
      echo
      "
      <script>
        alert('Successfully Added');
      </script>
      ";
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="Style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    body {
      font-family: Arail, sans-serif;
    }

    /* Formatting search box */
    .search-box {
      width: 300px;
      position: relative;
      display: inline-block;
      font-size: 14px;
    }

    .search-box input[type="text"] {
      height: 32px;
      padding: 5px 10px;
      border: 1px solid #CCCCCC;
      font-size: 14px;
    }

    .result {
      color: white;
      background: black;
      position: absolute;
      z-index: 999;
      top: 100%;
      left: 0;
      transition: 0.6s ease;
    }

    .search-box input[type="text"],
    .result {
      width: 100%;
      box-sizing: border-box;
    }

    /* Formatting result items */
    .result p {
      margin: 0;
      padding: 7px 10px;
      border: 1px solid white;
      border-top: none;
      cursor: pointer;
    }

    .result p:hover {
      color: #000000;
      background: #f2f2f2;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.search-box input[type="text"]').on("keyup input", function() {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
          $.get("backend-search.php", {
            term: inputVal
          }).done(function(data) {
            // Display the returned data in browser
            resultDropdown.html(data);
          });
        } else {
          resultDropdown.empty();
        }
      });

      // Set search input value on click of result item

      $(document).on("click", ".result p", function() {
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
      });
    });
  </script>
  <title>Upload Certificate</title>
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
            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            <a class="nav-link" href="../Result/">Result</a>
            <a class="nav-link text-danger" href="index.php">Certificate</a>
          </div>
          <div class="nav-item dropdown text white">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-fluid" style="width: 40px;" src="./../../Course/images/Profile.png" alt="PP">
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
    <h3 style="font-weight: bold;" class="text-center mt-3">Add Certificates</h3>
    <form style="display: flex; justify-content: center; flex-direction:column;" class="mt-3" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <div>
        <label for="name">Select User : </label>
        <div class="search-box">
          <input id="name" name="name" required type="text" autocomplete="off" placeholder="User" />
          <div class="result"></div>
        </div>
      </div>
      <div>
        <label for="image">Image : </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
      </div>
      <button type="submit" name="submit" class="btn btn-danger">Submit</button>
    </form>
    <br>

  </section>

  <Footer>
    <div class="bg-dark py-2">
      <h6 class="text-center text-light mt-2 bg-dark">
        Powered by <span class="text-danger bg-dark">Meaningless Compiler</span>
      </h6>
    </div>
  </Footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>