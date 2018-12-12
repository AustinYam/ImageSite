<?php
session_start();
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);


$_SESSION["user"]="";
$_SESSION["pass"]="";

if (isset($_POST['username']) && isset($_POST['password']))
{
	//$user="";
	//$pass="";
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	 $passwordunhash=SHA1($password);
	// echo $passwordunhash."</br>";
	
	$query = "SELECT userName from customer where userName='$username'";
		$result1 = $conn->query($query);
		while ($row = $result1->fetch_assoc()) {
		//	echo $row['userName']."<br>";
			$_SESSION["user"]=$row['userName'];
			}
			
			
			$query = "SELECT password from customer where password='$passwordunhash'";
		$result2 = $conn->query($query);
		while ($row = $result2->fetch_assoc()) {
			//echo $row['password']."<br>";
			$_SESSION["pass"]=$row['password'];
			}

			
	
	
	if ($username==$_SESSION["user"] && $passwordunhash===$_SESSION["pass"])
	{
		session_start();
        $_SESSION["authenticated"] = 'true';
		header("location: startScreen.php");
	}
	else
	{
		$message = "Incorrect Username or Password";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
}

?>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">	
		<style type="text/css">

		</style>
	</head>
	<body>
		<div class="container">
			<h1>Login</h1>
			<br>
			<form action="loginPage.php" method="post">
				<row>
					<p>Username</p> <input class="validate" type="text" name="username">
				</row>
				</row>
					<p>Password</p> <input class="validate" type="password" name="password">
				</row>
				<button class="btn waves-effect waves-light" type="submit" value="">Login</button>
			</form>
		</div>
	</body>
	<footer>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	</footer>
</html>
