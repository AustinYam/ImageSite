<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

require_once('authenticate.php');

$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];

if (isset($_POST['delete']) && isset($_POST['orderNumber']))
{
	//echo"kjjh";
	$id = get_post($conn, 'orderNumber');
	$query = "DELETE FROM transaction WHERE orderNumber='$id'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
</head>
<body>
	<!--NAVBAR-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<a class="navbar-brand" href="startScreen">Giggity</a>
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
			      <a class="nav-link" href="search.php">Search</a>
			  </li>
		       <form class="form-inline my-2 my-lg-0 ml-2" action="" method="post">
					<button class="btn btn-outline-success" type="submit" name="trending" >Popular</button>
			  </form>
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
	<div class="row ml-2">
		<?php 
		$boughtid= $_SESSION["tmpid"];

$query ="SELECT * FROM transaction where customerID='$boughtid'";
		$result = $conn->query($query);
		if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
		$rows = $result->num_rows;
		//echo "Items bought: ";
		while ($row = $result->fetch_assoc()) {
			
		$q= $row['orderNumber'];
		$t=$row['customerID'];
		$u=$row['imageID'];
		$v=$row['transactionDate'];
	}

	
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END
<div class=column style=float:left;padding:10 10 10 10>
	<div class="card">
	<img class = "card-image-top" src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">
	<div class="card-body">
	    <h5 class="card-title">$row[3]</h5>
	    <p class="card-text">Order Number: $row[0]</p>
	    <p class="card-text">Customer ID: $row[1]</p>
	    <p class="card-text">Image ID: $row[2]</p>
	    <p class="card-text">Transaction Date: $row[4]</p>
	    <form action="itemsBought.php" method="post">
			<input type="hidden" name="delete" value="yes">
			<input type="hidden" name="orderNumber" value="$row[0]">
			<input type="hidden" name="customerID" value="$row[1]">
			<input type="hidden" name="imageID" value="$row[2]">
			<input type="hidden" name="source" value="$row[3]">
			<input type="hidden" name="transactionDate" value="$row[4]">
			<button class="btn btn-outline-success" type="submit">Return</button>
		</form>
	  </div>
</div>
_END;
			}
			
			$result->close();
			$conn->close();
			function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);
			}	


		?>
	</div>
</body>
</html>