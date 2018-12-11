<?php
session_start();
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

$_SESSION["tmpid"]="";
$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];
echo $tmp."</br>";
echo $p."</br>";

$query = "SELECT id from customer where userName='$tmp' and password='$p'";
	$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
			echo "Welcome ".$tmp." , id: ".$row['id']."<br>";
			$_SESSION["tmpid"]=$row['id'];
			}
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	

echo <<<_END
<form action="startScreen.php" method="post">
<pre>
<input type="hidden" name="Music">
<input type="submit" value="browse images" formaction="ImageTest.php"><br>
</pre>
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