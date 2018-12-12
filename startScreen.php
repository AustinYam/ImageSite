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
<form action="startScreen.php" method="post">
<pre>
<input type="hidden" name="Music">
<input type="submit" value="browse images" formaction="ImageTest.php"><br>
</pre>
</form>
_END;

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