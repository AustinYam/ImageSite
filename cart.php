<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

require_once('authenticate.php');
$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];

if ($conn->connect_error) die($conn->connect_error);
$buyid= $_SESSION["tmpid"];
/*
if (isset($_POST['delete']) && isset($_POST['id']))
{
	echo"kjjh";
	$id = get_post($conn, 'id');
	$query = "DELETE FROM cart WHERE id='$id'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	}
	*/

//delete from cart
if (isset($_POST['delete']) && isset($_POST['id']) && isset($_POST['res']) && isset($_POST['size']) && isset($_POST['source']) && isset($_POST['category']))
{
	$id = get_post($conn, 'id');
	$res = get_post($conn, 'res');
	$size = get_post($conn, 'size');
	$name = get_post($conn, 'source');
		$cat = get_post($conn, 'category');
	
	$query = "INSERT INTO music VALUES('$id','$res','$size','$name','$cat')";
	$result = $conn->query($query);
	if (!$result) die("Database access failed: ". $conn->error);
	
	$query = "DELETE FROM cart WHERE id='$id'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	}

	if (isset($_POST['buy']) && isset($_POST['id']))
{
	$imageid = get_post($conn, 'id');
	//echo $imageid;
	
	$query ="SELECT * FROM cart";
		$result = $conn->query($query);
		
		while ($row = $result->fetch_assoc()) {
		$s[]=$row['id'];
		print_r ($s);
		$ts=$row['source'];
			$newts[]=substr_replace($ts, '.jpg',-7);
					
		
		
	}
		if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	$query = "SELECT id from customer where id='$buyid'";
	$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
			//echo "Welcome ".$tmp." , id: ".$row['id']."<br>";
			$ti=$row['id'];
			}
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	
	
		foreach ($s as $k => $v) {
			//foreach($newts as $b => $bit){
    $query ="INSERT INTO transaction VALUES(NULL,'$ti','$s[$k]','$newts[$k]',CURDATE())";
	$result = $conn->query($query);
	if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
			//}
}

	
	$query = "DELETE FROM cart";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	
	}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
<head>
	<title></title>
</head>
<body>
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
	<div class="row">
		<?php
			 $query ="SELECT * FROM cart";
		$result = $conn->query($query);
		if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
		echo "</br>";
		while ($row = $result->fetch_assoc()) {
			
		$q= $row['id'];
		$t=$row['resolution'];
		$u=$row['size'];
		$v=$row['source'];
	}

	
	$query = "SELECT * FROM cart";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		$rows = $result->num_rows;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END
<div class="column ml-2 mb-5" style=float:left;padding:10 10 10 10>
	<div class="card" style="width: 15rem;">
	  <img class="card-img-top" src= $row[3] alt="HTML5 Icon">
	  <div class="card-body">
	    <h5 class="card-title">$row[3]</h5>
	    <p class="card-text">id: $row[0]</p>
	    <p class="card-text">resolution: $row[1]</p>
	    <p class="card-text">size: $row[2]</p>
	    <p class="card-text">category: $row[4]</p>
	  
		<form class = "mt-2" action="ImageTest.php" method="post">
			<input type="hidden" name="delete" value="yes">
			<input type="hidden" name="id" value="$row[0]">
			<input type="hidden" name="res" value="$row[1]">
			<input type="hidden" name="size" value="$row[2]">
			<input type="hidden" name="source" value="$row[3]">
			<input type="hidden" name="category" value="$row[4]">
			<button class = "btn btn-outline-success" type="submit">Remove</button>
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
	<div class="row ml-4 mb-5" style="position: absolute; bottom: 0">
		<form action="cart.php" method="post">
			<input type="hidden" name="id" value="">
			<input type="hidden" name="buy" value="yes">
			<button class="btn btn-outline-success" type="submit">Purchase</button>
		</form>
	</div>
</body>
<footer>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</footer>
</html>