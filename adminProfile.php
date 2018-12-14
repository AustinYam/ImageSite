<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

require_once('authenticate.php');

$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];


if (isset($_POST['searchbycust']) && isset($_POST['entercust']))
{
	$custid = $_POST['entercust'];
	$query = "SELECT * FROM transaction WHERE customerID='$custid'";
	$result = $conn->query($query);
	
	while ($row = $result->fetch_assoc()) {
		$s=$row['orderNumber'];	
		$t=$row['customerID'];
		$u=$row['imageID'];
		$v=$row['source'];
		$w=$row['transactionDate'];
	}
	$rows = $result->num_rows;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END

<div class=column style=float:left;padding:10 10 10 10>
<pre>
orderNumber: $row[0]
customerID: $row[1]
imageID: $row[2]
source: $row[3]
transactionDate: $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">
</pre>
_END;

			}		
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	}
	


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Open+Sans);

	body{
	  background: #f2f2f2;
	  font-family: 'Open Sans', sans-serif;
	}

	.search {
	  width: 100%;
	  position: relative
	}

	.searchTerm {
	  float: left;
	  width: 100%;
	  border: 3px solid #28a745;
	  padding: 5px;
	  height: 40px;
	  border-radius: 5px;
	  outline: none;
	  color: #28a745;
	}

	.searchTerm:focus{
	  color: #000000;
	}

	.searchButton {
	  position: absolute;  
	  right: -30px;
	  width: 40px;
	  height: 38px;
	  border: 1px solid #28a745;
	  background: #28a745;
	  text-align: center;
	  color: #fff;
	  border-radius: 5px;
	  cursor: pointer;
	  font-size: 20px;
	}

	/*Resize the wrap to see the search bar change!*/
	.wrap{
	  width: 30%;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	}

	@font-face{font-family:'Calluna';
 src:url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/callunasansregular-webfont.woff') format('woff');
}
body {
	background: url(//subtlepatterns.com/patterns/scribble_light.png);
  font-family: Calluna, Arial, sans-serif;
  min-height: 1000px;
}
#columns {
	column-width: 320px;
	column-gap: 15px;
  width: 90%;
	max-width: 1100px;
	margin: 50px auto;
}

div#columns figure {
	background: #fefefe;
	border: 2px solid #fcfcfc;
	box-shadow: 0 1px 2px rgba(34, 25, 25, 0.4);
	margin: 0 2px 15px;
	padding: 15px;
	padding-bottom: 10px;
	transition: opacity .4s ease-in-out;
  display: inline-block;
  column-break-inside: avoid;
}

div#columns figure img {
	width: 100%; height: auto;
	border-bottom: 1px solid #ccc;
	padding-bottom: 15px;
	margin-bottom: 5px;
}

div#columns figure figcaption {
  font-size: .9rem;
	color: #444;
  line-height: 1.5;
}

div#columns small { 
  font-size: 1rem;
  float: right; 
  text-transform: uppercase;
  color: #aaa;
} 

div#columns small a { 
  color: #666; 
  text-decoration: none; 
  transition: .4s color;
}

div#columns:hover figure:not(:hover) {
	opacity: 0.4;
}

@media screen and (max-width: 750px) { 
  #columns { column-gap: 0px; }
  #columns figure { width: 100%; }
}

	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<h2 class="display-5"><a class="navbar-brand" href="startScreen.php">Welcome to Aurora</a></h2>
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
		      <li class="nav-item"> 
			      <a class="nav-link" href="searchTransaction.php">Search</a>
			  </li>
			  <li class="nav-item" style="position: absolute; right: 0">
		      	<div>
		      		<a href="cart.php"><button class="btn btn-success mr-2"><i class="fa fa-shopping-cart mr-2"></i>Cart</button></a>
		      	</div>
		      </li>
		       <li class="nav-item mr-5" style="position: absolute; right: 0">
		      	<div class="dropdown mr-5">
		      		<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome, <?= $tmp ?>
		      		</button>
		      		<div class="dropdown-menu">
		      			<a class="dropdown-item" href="#">Wallet: $<?= $tcustcre ?></a>
					    <div class="dropdown-divider"></div>
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
	<div class="card" style="position: absolute;right: 0">
		<?php
				$query = "select distinct source,imageID from transaction"; 
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_array($result)){
					echo "<div id = 'img_div'>";
						echo "<img src = '".$row['source']."' height = '100' width = '100'>";
						echo "<form method='post'>";
                			echo "<input type='hidden' name='enterimg' id='image' value = '".$row['imageID']."' />";
                 			echo "<button class = 'btn btn-success' type='submit' name='searchbyimg' id='delete'>Select</button>";
            			echo "</form>  ";
					echo "</div> ";

				}
			?>
	</div>

		<?php

			if (isset($_POST['searchbyimg']) && isset($_POST['enterimg']))
{
	$imgid = $_POST['enterimg'];
	$query = "SELECT * FROM transaction WHERE imageID='$imgid'";
	$result = $conn->query($query);
	
	while ($row = $result->fetch_assoc()) {
		$s=$row['orderNumber'];	
		$t=$row['customerID'];
		$u=$row['imageID'];
		$v=$row['source'];
		$w=$row['transactionDate'];
	}
	$rows = $result->num_rows;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END


<figure>
<div class="column ml-2 mb-5" style=float:left;padding:10 10 10 10>
	<div class="card" style="width: 15rem;">
	  <img class="card-img-top" src= $row[3] alt="HTML5 Icon">
	  <div class="card-body">
	    <p class="card-text">id: $row[0]</p>
	    <p class="card-text">customerID: $row[1]</p>
	    <p class="card-text">imageID: $row[2]</p>
	  </div>
	</div>
</div>
</figure>
_END;

			}
			if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	}
			

		?>
	</div>
</body>
</html>