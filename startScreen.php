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

	
	
	
	if (isset($_POST['trending']))
{
	$query = "select * from transaction group by source order by count(*) desc;";
	$result = $conn->query($query);
	if (!$result) echo "Select failed: $query<br>" . $conn->error . "<br><br>";
	$rows = $result->num_rows;
		echo "Items bought: ";
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
<pre>
source: $row[3]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">

</pre>
<form action="itemsBought.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="hidden" name="source" value="$row[3]">
<input type="submit" value="CHOOSE RECORD">
</form>
</div>
_END;
			}
			
			$result->close();
			$conn->close();
			function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);
			}	
	}
	
	

echo <<<_END
<form action="" method="post">
<input type="submit" name="trending" value="TRENDING">

</form>
_END;

//log out
echo <<<_END
<form action="loginPage.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="LOG OUT">
</form>
_END;
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
		        <a class="nav-link" href="ImageTest.php">Browse</a>
		      </li>
		      <form class="form-inline my-2 my-lg-0 ml-5">
			      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    	  </form>
		    </ul>
		    <ul class="navbar-nav">
		    	<form action="loginPage.php" method="post">
		    		Welcome, <?= $tmp ?>
			    	 <li class="nav-item">
			    	 	<input type="hidden" name="choose" value="yes">
				        <a class="nav-link" value="Log out" href="logout.php">Logout</a>
				     </li>
			     </form>
		    </ul>
		  </div>
	</nav>
</body>
<footer>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</footer>
</html>