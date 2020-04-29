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
$stm = "SELECT mid from menu where rid=".$rid."";
$count = $link->query($stm);
$size = mysqli_num_rows($count);
echo $_POST['item1'];
  $order = 'INSERT INTO orders (mid, name, quantity, price, id) values ';
for($i = 1; $i <= $size; $i++){
  $order .= '('.$_POST["mid".$i.""].', "'.$_POST["item".$i.""].'", '.$_POST["quantity".$i.""].', '.$_POST["price".$i.""].', '.$user_Id.'';
  ($i == $size) ? $order.=');' :  $order.='),';

}
if ($link->query($order) === TRUE) {
  header('location: bill.php');
} else {
    echo "Error: " . $order . "<br>" . $link->error;
}
}

$sql = "SELECT descr, mid, name, price, categ FROM menu WHERE rid= ".$rid."";
$result = $link->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOOM</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/register.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/main.css">

<style>
  .table{
     display: block !important;
     overflow-x: auto !important;
     width: 100% !important;
   }
   body {
    /* Set "my-sec-counter" to 0 */
    counter-reset: my-sec-counter;
  	height: 100%;
  	font-family: ;/*courier garamond candara*/
  	color: black;
  }

  #num::before {
    /* Increment "my-sec-counter" by 1 */
    counter-increment: my-sec-counter;
    content: " " counter(my-sec-counter) ". ";
  }
</style>
</head>

<body>
<!-- ** NAV BAR ** -->
<nav id = "navbarColor" class="navbar navbar-expand-lg navbar-light  navbar-fixed">
    <a class="navbar-brand" href="#">L O O M</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
           <a class="nav-link" href="profile-Customer.php">Finder</a>
        </li>
        <li class="nav-item active">
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

<div class="container">
	<div class="col-sm-12">
		<h2>Order Now</h2>
</div>

<div class="wrapper">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="form1" method="post" class="needs-validation">
    <!--<input style='width: %' type='text' class='form-control w-50' placeholder='Table #' name='quantity'  required>-->
    <div class="card-columns">
      <?php
      if ($result->$num_rows > 0) {
          // output data of each row
          $num = 0;
          while($row = $result->fetch_assoc()) {
            $num++;
              echo "<div class='card card-body'><span class='float-right font-weight-bold'>$".$row["price"]."</span><h6 class='text-truncate'>".$row["name"]."</h6><p class='small'>".$row["descr"]."</p><span class='font-weight-bold small'></span><input style='width: 16%' type='number' class='form-control float-right' placeholder='0' name='quantity".$num."'  required><input type='hidden' name='mid".$num."' value='".$row["mid"]."'><input type='hidden' name='item".$num."' value='".$row["name"]."'>
              <input type='hidden' name='price".$num."' value='".$row["price"]."'></div>";
          }
      } else {
          echo "No Menu uploaded";
      }
      $link->close();
      ?>
    </div>
    <div class="col-sm-12 text-center">
      <button type="submit" value="Login" class="btn btn-outline-dark text-center">Place Order</button>
    </div>
  </form>
</div>


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
