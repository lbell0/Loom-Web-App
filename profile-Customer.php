<?php
// Initialize the session
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login-Customer.php");
    exit;
}

// Include config file
require_once "config.php";

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

</head>

<!-- ** NAV BAR ** -->
<nav id = "navbarColor" class="navbar navbar-expand-lg navbar-light  navbar-fixed">
  <a class="navbar-brand" href="index.html">L O O M</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data- target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
         <a class="nav-link" href="profile-Customer.php">Finder</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="order.php">Order</a>
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

<div class="container h-100 text-center">
	<div class="col-sm-12s">
		<h2>Find Restaurants</h2>
    <hr><br>
    <div type="text" class="input-group mb-3" contentEditable=true data-text="Search...">
      <div class="input-group-prepend">
        <button type="button" class="btn btn-outline-secondary">Filter Search</button>
        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Fast</a>
          <a class="dropdown-item" href="#">Asian</a>
          <a class="dropdown-item" href="#">Bar</a>
          <div role="separator" class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Type</a>
        </div>
       </div>
      <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
    </div>
  </div>
</div>




<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'><div class='card-header font-weight-bold'>Name: ". $row["rName"]."<span class='float-right'><button class='btn btn-outline-dark' onclick='click()' value=".$row["rid"].">Select</button></span></div><div class='card-body'>Address: ". $row["address"]."</div></div>";
    }
} else {
    echo "0 results";
}
$link->close();
?>

<script>
  $("button").click(function() {
    //document.cookie = 'rid=
    var fired_button = $(this).val();
    document.cookie = 'rid='+fired_button+';';
    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }
  window.location.href = 'profile-Customer.php';
  });
</script>


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
