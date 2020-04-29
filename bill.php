<?php
// Initialize the session
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: user_login.php");
    exit;
}

// Include config file
require_once "config.php";

$rid = $_COOKIE["rid"];

$user_Id = $_SESSION["id"];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

}

$sql = "SELECT order_Id, name, quantity, price FROM orders WHERE id= ".$user_Id."";
$result = $link->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>DBMS</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/register.css">
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
      <a class="nav-link" href="index.html">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="profile.php">Order</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php"><br>Logout</a>
    </li>
  </ul>
</div>

</nav>
<div class="container ">
	<div class="col-sm-12">
		<h2>Your Order</h2>
</div>

<div class="wrapper">
<!--<input style='width: %' type='text' class='form-control w-50' placeholder='Table #' name='quantity'  required>-->
<div class="card-columns mx-auto">
  <div class="card card-body" style="width: 200%">
    <h4 class="font-weight-lighter">Customer Receipt</h4>
    <hr>

<?php
$sum = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sum += $row['price'] * $row['quantity'];
      echo "    <span class='float-right font-weight-lighter'><em> ...........  $".$row['price']."</em></span><h6 class='text-truncate font-weight-normal'>".$row['name']."</h6><p class='small' style='text-indent: 5%;'>x".$row['quantity']."</p>";
    }
} else {
    echo "No Menu uploaded";
}
$link->close();
?>

      <span class='font-weight-bold'>Order total: <em><?php echo $sum ?></em></span>

    </div>
  </div>
</div>

<div class="col-sm-12 text-center">
  <button type="submit" value="Login" class="btn btn-outline-dark text-center">Pay</button>
</div>
</div>

<!-- ** FOOTER ** -->
<footer class="page-footer font-small cyan darken-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ">
        <div class="col-sm-3 mx-auto">
          <a href="#" class="fa fa-facebook"></a>
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-instagram"></a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="#" style="color: black"><strong>dbms.com</strong></a>
  </div>
</footer>


	<script>
	$(function () {

  $("#search-query").autocomplete({
      source: function (request, response) {
         $.ajax({
            url: "/search_member",
            type: "GET",
            data: request,  // request is the value of search input
            success: function (data) {
              // Map response values to fiedl label and value
               response($.map(data, function (el) {
                  return {
                     label: el.fullname,
                     value: el._id
                  };
                  }));
               }
            });
         },

         // The minimum number of characters a user must type before a search is performed.
         minLength: 3,

         // set an onFocus event to show the result on input field when result is focused
         focus: function (event, ui) {
            this.value = ui.item.label;
            // Prevent other event from not being execute
            event.preventDefault();
         },
         select: function (event, ui) {
            // Prevent value from being put in the input:
            this.value = ui.item.label;
            // Set the id to the next input hidden field
            $(this).next("input").val(ui.item.value);
            // Prevent other event from not being execute
            event.preventDefault();
            // optionnal: submit the form after field has been filled up
            $('#quicksearch').submit();
         }
  });

});
</script>

</body>
</html>
