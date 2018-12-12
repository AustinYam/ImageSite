<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

require_once('authenticate.php');

$_SESSION["tmpid"]="";
$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];

$query = "SELECT id from customer where userName='$tmp' and password='$p'";
	$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
			//echo "Welcome ".$tmp." , id: ".$row['id']."<br>";
			$_SESSION["tmpid"]=$row['id'];
			}
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<!--NAVBAR-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<a class="navbar-brand" href="#">Giggity</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		 </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="startScreen.php">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="ImageTest.php">Upload</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="ItemsBought.php">Purchases</a>
		      </li>
		      <form class="form-inline my-2 my-lg-0 ml-5">
			      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		      </form>
		       <li class="nav-item mr-5" style="position: absolute; right: 0">
		      	<div class="dropdown">
		      		<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome, <?= $tmp ?>
		      		</button>
		      		<div class="dropdown-menu">
					    <a class="dropdown-item" href="cart.php">Cart</a>
					    <a class="dropdown-item" href="ItemsBought.php">Purchases</a>
					    <a class="dropdown-item" href="ImageTest.php">Upload</a>
					    <div class="dropdown-divider"></div>
					    <a class="dropdown-item" href="logout.php">Logout</a>
					</div>
		      	</div>
		      </li>
		    </ul>
		  </div>
	</nav>
</body>
<footer>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</footer>
</html>