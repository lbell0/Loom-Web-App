<!DOCTYPE html>
<html lang="en">
<head>
  <title>LOOM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/register.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>

<style>
    h2 {
      font-family: papyrus;
      text-align: center;
      font-size: 30px;
      padding: 30px 20px;
    }
</style>

</head>

<body>

<!-- ** NAV BAR ** -->
<nav id = "navbarColor" class="navbar navbar-expand-lg navbar-light  navbar-fixed">
  <a class="navbar-brand" href="index.html">L O O M</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
  	<span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
  	<ul class="navbar-nav mr-auto">
  		<li class="nav-item active">
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


<div class="container">
    <h2>Where would you like to go?</h2>
    <hr style="width:60%">
  	<div class="card-deck mb-3 text-center" style="padding-top: 50px">
  		<div class="card mb-4 box-shadow">
  			<div class="card-body">
				    <a href="menu-create.php"><button type="button" class="btn btn-lg btn-block"><strong>Create menu</strong></button></a>
			  </div>
		 </div>
	 	 <div class="card mb-4 box-shadow">
			 <div class="card-body">
					 <a href="menu-view.php"><button type="button" class="btn btn-lg btn-block"><strong>View menu</strong></button></a>
			 </div>
		 </div>
	</div>
</div>

  <br><br><br>
  <h6 class="text-center" style="font-style: italic; font-weight: 350; color:#9d9d9d">
    <strong>Create menu</strong> allows you to enter information to upload into the system.
    <br><br>
    <strong>View menu</strong> allows you to view your current menu that is in the system.
  </h6>

  <!-- ** FOOTER ** -->
  <footer class="page-footer font-small cyan darken-3" style="margin-top:35%">
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

</body>
</html>
