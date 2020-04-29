<?php
// Initialize the session
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login-Restaurant.php");
    exit;
}

// Include config file
require_once "config.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $num = $_COOKIE["max"];
  //$sql =  INSERT INTO restaurants (name, descr, price) values
  $stm = 'INSERT INTO menu (price, name, descr, rid) values ';
  //$num1 = $num2 = $num3 = 0;
  //echo $_POST['price'.$name.''];
  for($i = 1; $i <= $num; $i++){
    $stm .= '(';
    $num1 = $_POST['price'.$i.''];
    $stm.= '"'.$num1.'",';

    $num2 = $_POST['name'.$i.''];
    $stm.= '"'.$num2.'",';

    $num3 = $_POST['description'.$i.''];
    $stm.= '"'.$num3.'"';

    $stm.= ',"'.$_SESSION['id'].'"';
    if($i == $num){
      $stm .= ')';
    }else{
      $stm .= '),';
    }
  }
  $stm .= ';';

  if ($link->query($stm) === TRUE) {
      //echo "New record created successfully";
  } else {
      echo "Error: " . $stm . "<br>" . $link->error;
  }
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

  <script> var count = 1; </script>

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
			<a class="nav-link" href="menu-nav.php">Menu</a>
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


<div class="container col-sm-12 text-center">
  <h2>Create Menu</h2>
  <hr>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="form1" method="post" class="needs-validation">
  <div class="container">
  <div class="card-columns">
    <div class="card card-body" id="foo1">
        <div class="form-group">
            <label class="font-weight-bold">Item Name</label>
            <input style="width: 100%" type="text" class="form-control" minLength="4" maxlength="20" placeholder="Ex: Fried Shrimp" name="name1"  required>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Price</label>
            <input style="width: 100%" type="number" class="form-control" minLength="1" maxlength="20" placeholder="$0.00" name="price1"  required>
       </div>
       <div class="form-group">
          <label class="font-weight-bold">Item Description</label>
          <textarea name="description1" class="form-control" id="exampleFormControlTextarea1" placeholder="Ex: Sustainably raised Argentine red shrimp, fried golden brown and served with chipotle mayonnaise for dipping." rows="3" required></textarea>
       </div>
       <div class="text-right">
          <button class="btn btn-outline-dark" id='main' onclick="myFunction()">+</button>
       </div>
    </div>
  </div>
    <div class="text-center">
      <button type="submit" value="Login" onclick="max()" class="btn btn-outline-dark">Create Menu</button>
    </div>
  </div>
</form>

<script>
function myFunction() {
  count++;
  var elem;
  elem = "<div class='card card-body' id='menu_items'><span class='float-right font-weight-bold'><div class='form-group'><label class='font-weight-bold'>Price</label><input style='width: 50%' type='number' class='form-control' minLength='1' maxlength='20' placeholder='$0.00' name='price"+count+"' required></div></span><div class='form-group'><label class='font-weight-bold'>Item Name</label><input style='width: 25%' type='text' class='form-control' minLength='4' maxlength='20'"; elem+="placeholder='Ex: Fried Shrimp' name='name"+count+"'  required></div><div class='form-group'><label class='font-weight-bold'>Item Description</label><textarea name='description"+count+"' class='form-control' placeholder='Ex: Sustainably raised Argentine red shrimp, fried golden brown and served with chipotle mayonnaise for dipping.' rows='3'></textarea></div><div class='text-right'><button class='btn btn-outline-dark' id='main' onclick='myFunction()'>+</button></div></div>";
  $('#foo1').after(elem);
}

function max(){
  document.cookie = "max="+count+"";
}
</script>


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
    <a href="#" style="color: black"><strong>Loom.com</strong></a>
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
