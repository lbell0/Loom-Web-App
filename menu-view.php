<?php
// Initialize the session
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login-Restaurant.php");
    exit;
}

// Include config file
require_once ('config.php');

$query = "SELECT name, price, descr FROM menu";

// Get a response from the database by sending the connection and the query
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response) {
  echo '<table align="left" cellspacing="5" cellpadding="8">
    <tr><td align="left"><b>Item name</b></td>
    <td align="left"><b>Price</b></td>
    <td align="left"><b>Description</b></td></tr>';

    // mysqli_fetch_array will return a row of data from the query
    // until no further data is available
    while($row = mysqli_fetch_array($response)){

      echo '<tr><td align="left">' .
      
      $row['name'] . '</td><td align="left">' .
      $row['price'] . '</td><td align="left">' .
      $row['descr'] . '</td><td align="left">';

      echo '</tr>';
    } echo '</table>';
  } else {
      echo "Couldn't issue database query<br />";
      echo mysqli_error($dbc);
    }

// Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOOM</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/main.css">

</head>


<!-- ** NAV BAR ** -->
<nav id = "navbarColor" class="navbar navbar-expand-lg navbar-light  navbar-fixed">
<a class="navbar-brand" href="index.html">L O O M</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarText">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item">
			<a class="nav-link" href="profile-Restaurant.php">Create</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="about.php">About</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="contact.php">Contact</a>
		</li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
	</ul>
</div>
</nav>





<!-- ** FOOTER ** -->
<footer class="page-footer font-small cyan darken-3" style="margin-top:30%">
  <div class="container text-center">
    <span class="navbar-text">
      <a href="#" class="fa fa-facebook"></a>
      <a href="#" class="fa fa-twitter"></a>
      <a href="#" class="fa fa-instagram"></a>
    </span>
  </div>
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a><strong>Loom.com</strong></a>
  </div>
</footer>


</body>
</html>
