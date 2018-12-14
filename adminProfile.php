<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
<form action="adminProfile.php" method="post">
search by customer id<type="label">
<input type="text" name="entercust">
<input type="submit" value="search" name="searchbycust">
</form>
_END;
echo "</br>";
echo "</br>";
echo "OR"."</br>";
echo "</br>";
echo <<<_END
<form action="adminProfile.php" method="post">
search by image id<type="label" name="">
<input type="text" name="enterimg">
<input type="submit" value="search" name="searchbyimg">
</form>
_END;

if (isset($_POST['searchbycust']) && isset($_POST['entercust']))
{
	$custid = $_POST['entercust'];
	$query = "SELECT * FROM transaction WHERE customerID='$custid'";
	$result = $conn->query($query);
	
	while ($row = $result->fetch_assoc()) {
		$s=$row['orderNumber'];	
		$t=$row['customerID'];
		$u=$row['imageID'];
		$v=$row['source'];
		$w=$row['transactionDate'];
	}
	$rows = $result->num_rows;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END

<div class=column style=float:left;padding:10 10 10 10>
<pre>
orderNumber: $row[0]
customerID: $row[1]
imageID: $row[2]
source: $row[3]
transactionDate: $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">
</pre>
_END;

			}		
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	}
	
	if (isset($_POST['searchbyimg']) && isset($_POST['enterimg']))
{
	$imgid = get_post($conn, 'enterimg');
	echo $custid;
	$query = "SELECT * FROM transaction WHERE imageID='$imgid'";
	$result = $conn->query($query);
	
	while ($row = $result->fetch_assoc()) {
		$s=$row['orderNumber'];	
		$t=$row['customerID'];
		$u=$row['imageID'];
		$v=$row['source'];
		$w=$row['transactionDate'];
	}
	$rows = $result->num_rows;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END

<div class=column style=float:left;padding:10 10 10 10>
<pre>
orderNumber: $row[0]
customerID: $row[1]
imageID: $row[2]
source: $row[3]
transactionDate: $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">
</pre>
_END;

			}		
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	}
	

?>