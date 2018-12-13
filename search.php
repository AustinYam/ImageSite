<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

require_once('authenticate.php');

$_SESSION["tmpid"]="";
$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];

//search
echo <<<_END
_END;

if (isset($_POST['search']) && isset($_POST['enter']))
{
	$t=array();
	$q=array();
	$value=array();
	$val="";
	$category = get_post($conn, 'enter');
	//echo $category;
	echo "</br>";
	//$query = "SELECT * FROM music WHERE category='$category'";
	$query = "SELECT * FROM music";
	$result = $conn->query($query);
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	$rows = $result->num_rows;
	while ($row = $result->fetch_assoc()) {
			
		$q[]= $row['source'];
		foreach($q as $value)
		{
			$value=strtolower(substr($value, 0, -7));
			
		}
		$test[]=$value;
		//echo $value;
		//$val=$value;
		
		$t[]=$row['category'];
		//echo $q;
		
		//print_r ($t);
	}
	echo "</br>";
	//print_r($t);
	//print_r($test);
	//echo $category;
	if(in_array($category, $t)!==false)
	{

	$query = "SELECT * FROM music WHERE category like '$category'";
	$result = $conn->query($query);
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
while ($row = $result->fetch_assoc()) {
		$q[]= $row['source'];
		foreach($q as $value)
		{
			$value=strtolower(substr($value, 0, -7));
			
		}
		$test[]=$value;
	}	
	$rows = $result->num_rows;
	for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END
<div class=column style=float:left;padding:10 10 10 10>
<pre>
id $row[0]
resolution $row[1]
size $row[2]
source $value
category $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">

</pre>
<form action="ImageTest.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="DELETE RECORD">
</form>
<form action="ImageTest.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="CHOOSE RECORD">
</form>
</div>
_END;
			}		
	}
	
	//echo $category;
	 if(in_array($category, $test)!==false)
	{
		//echo $category;
		echo "</br>";
		echo $val;
	echo "yes";
	$query = "SELECT * from music where LOWER(substr(source from 1 for char_length(source)-7)) = LOWER('$category')";
	$result = $conn->query($query);
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";	
	while ($row = $result->fetch_assoc()) {
		$q[]= $row['source'];
		foreach($q as $value)
		{
			$value=strtolower(substr($value, 0, -7));
			
		}
		$test[]=$value;
	}
	$rows = $result->num_rows;
	for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END
<div class=column style=float:left;padding:10 10 10 10>
<pre>
id $row[0]
resolution $row[1]
size $row[2]
source $value
category $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">

</pre>

<form action="ImageTest.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="DELETE RECORD">
</form>
<form action="ImageTest.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="CHOOSE RECORD">
</form>
</div>
_END;
			}		
	}
			
	}
$query = "SELECT * FROM music";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		$rows = $result->num_rows;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
			}		
			$result->close();
			$conn->close();
			function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);
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
		        <a class="nav-link" href="ImageTest.php"><?= $tmp ?>'s Wall</a>
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
	<div class="container-fluid">
		<form action="" method="post">
			<input class="mt-2" type="search" name="enter">
			<type="label" name="searchby">
			<button class="btn btn-outline-success" type="submit" name="search">Search</button>
		</form>
	</div>
</body>
</html>