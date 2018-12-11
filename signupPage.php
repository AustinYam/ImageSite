<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
_END;
 //create customer (html by professor)
 if ( isset($_POST['id']) && isset($_POST['lastName']) &&isset($_POST['firstName']) && isset($_POST['userName']) &&isset($_POST['password']) &&isset($_POST['userType']))
 {
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
		$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
		$userName = mysqli_real_escape_string($conn, $_POST['userName']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$userType = mysqli_real_escape_string($conn, $_POST['userType']);
		$query = "INSERT INTO customer VALUES('$id','$lastName','$firstName','$userName',SHA1('$password'),'$userType')";
	#	$query = "INSERT INTO customer VALUES(NULL,'miller','james','charlie123','123','admin')";
		$result = $conn->query($query);
		if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
		
		
		header("location: loginPage.php");
	
		
 }

?>
	<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	</head>
		<body>
			<div class="container">
				<h3>Sign Up</h3>
				<form action="signupPage.php" method="post">
					<row>
						<p>Username</p> <input class="valid" type="text" name="userName">
					</row>
					<row>
						<p>Password</p> <input type="password" name="password">
					</row>
					<row>
						<p>FirstName</p> <input type="text" name="firstName">
					</row>
					<row>
						<p>lastName</p> <input type="text" name="lastName">
					</row>
					<row>
						<p>User Type</p> <input type="Text" name="userType">
					</row>
				<button class="btn waves-effect waves-light" type="submit" value="ADD RECORD">Register</button>
				</form>
			</div>
		</body>
</html>