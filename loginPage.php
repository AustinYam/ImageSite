<?php
session_start();
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

echo <<<_END
<h1>Welcome to our fockin images website</h1>
_END;

$_SESSION["user"]="";
$_SESSION["pass"]="";

if (isset($_POST['username']) && isset($_POST['password']))
{
	//$user="";
	//$pass="";
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	 $passwordunhash=SHA1($password);
	 echo $passwordunhash."</br>";
	
	$query = "SELECT userName from customer where userName='$username'";
		$result1 = $conn->query($query);
		while ($row = $result1->fetch_assoc()) {
			echo $row['userName']."<br>";
			$_SESSION["user"]=$row['userName'];
			}
			
			
			$query = "SELECT password from customer where password='$passwordunhash'";
		$result2 = $conn->query($query);
		while ($row = $result2->fetch_assoc()) {
			echo $row['password']."<br>";
			$_SESSION["pass"]=$row['password'];
			}
			
	
	
	if ($username==$_SESSION["user"] && $passwordunhash===$_SESSION["pass"])
	{
		header("location: startScreen.php");
	}
	else
	{
		echo "nah bruh"."</br>";
	}
}

echo <<<_END
<form action="loginPage.php" method="post">
<pre>
username <input type="text" name="username">
password <input type="text" name="password">
<input type="submit" value="LOGIN">
</pre>
</form>
_END;
?>
