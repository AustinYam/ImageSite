<?php
session_start();
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
<form action="startScreen.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="HOME">
</form>
_END;

if (isset($_POST['delete']) && isset($_POST['orderNumber']))
{
	//echo"kjjh";
	$id = get_post($conn, 'orderNumber');
	$query = "DELETE FROM transaction WHERE orderNumber='$id'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	}

$boughtid= $_SESSION["tmpid"];
echo $boughtid;

$query ="SELECT * FROM transaction where customerID='$boughtid'";
		$result = $conn->query($query);
		if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
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
orderNumber $row[0]
customerID $row[1]
imageID $row[2]
source $row[3]
transactionDate $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">

</pre>
<form action="itemsBought.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="orderNumber" value="$row[0]">
<input type="hidden" name="customerID" value="$row[1]">
<input type="hidden" name="imageID" value="$row[2]">
<input type="hidden" name="source" value="$row[3]">
<input type="hidden" name="transactionDate" value="$row[4]">
<input type="submit" value="DELETE RECORD">
</form>
</div>
_END;
			}
			
			$result->close();
			$conn->close();
			function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);
			}	


?>