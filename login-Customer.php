<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}*/

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["cUsername"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["cUsername"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["cPassword"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["cPassword"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT cid, cUsername, cPassword FROM customers WHERE cUsername = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            /*--Redirect user to CUSTOMER profile page--*/
                            header("location: profile-Customer.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
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
  <title>LOOM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(":input").inputmask();

      $("#phone").inputmask({
      mask: '999 999 9999',
      placeholder: ' ',
      showMaskOnHover: false,
      showMaskOnFocus: false,
      onBeforePaste: function (pastedValue, opts) {
      var processedValue = pastedValue;
      //do something with it
      return processedValue;
      }
    });
});
</script>

<style>
body {
  	background-image: url('img/indexbg.jpg');
  	background-repeat: no-repeat;
  	background-attachment: fixed;
  	background-size: cover;
}
.fa {
  padding: 20px;
  font-size: 24px;
  width: ;
  text-align: center;
  text-decoration: none;
  border-radius: 50%;
  color: black;
}
.alignleft {
    float: left;
    margin-right: 15px;
}
.alignright {
    float: right;
    margin-left: 15px;
}
.aligncenter {
    display: block;
    margin: 0 auto 15px;
}
.fix {
  overflow: hidden
}
html, body {
  height: 100%
}
a {
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -webkit-transition: 0.3s;
  transition: 0.3s;
  color: #333;
}
a:hover {
  text-decoration: none
}
.navbar-toggler
{
  border: none!important; /*impt bc overriding classes/no border*/
}
.loginForm input[type=text], .loginForm input[type=password] {
  margin-bottom:10px;
}
.loginForm input[type=submit] {
  background:#fb044a;
  color:#fff;
  font-weight:700;
}
.container h2
{
  font-family: papyrus;
  color: #FFF8EE!important;
}
.container label,
.footer-copyright,
.footer-copyright a
{
  color:#FFF8EE!important;
}
.needs-validation button
{
  padding: 10px 25px;
  font-size: 17px;
  margin-top: 40px;
}
</style>
</head>

<body>
  <!-- ** NAV BAR ** -->
  <nav id = "navbarColor" class="navbar navbar-expand-lg navbar-dark navbar-fixed">
    <a class="navbar-brand" href="#" style="font-family: papyrus; color:#FFF8EE"><strong>LOOM</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/Loom/index.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Contact</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
      </span>
    </div>
  </nav>

<!-- ** LOGIN FORUM ** -->
<div class="container h-100 col-sm-8" style="margin-top: 12%">
  <h2 style="font-size: 40px;">Customer Login</h2>
	<hr>
    <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation">
      <div class="form-group">
        <label for="email">Username:</label>
        <input type="text" class="form-control" id="uname" placeholder="Enter username" name="cUsername" value="<?php echo $username; ?>" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="cPassword" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
      </div>
      <div class="form-group form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="remember"> Remember Me
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Invalid</div>
    			</div>
        </label>
        <div class="row">
      </div>
      <div class="row">
        <div class="col-md- mx-auto">
      <button type="submit" value="Login" class="btn btn-outline-light">Login</button>
    </div>
    </div>
    <div class="footer-copyright text-center py-3">
      <hr class="w-25">
      <div class="footer-copyright text-center py-3">
        <a href="/Loom/register-Customer.php"> Don't have an account? <strong> Click here</strong></a>
      </div>
    </div>
  </form>
</div>
</body>
</html>
