<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
require_once('authenticate.php');

$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];
$boughtid= $_SESSION["tmpid"];

echo <<<_END
<form action="startScreen.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="Home">
</form>
_END;

//search
echo <<<_END
<form action="" method="post">

<input type="text" name="enter">
Enter name or category of any image <type="label" name="searchby">
<input type="submit" name="search" value="SEARCH">

</form>
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
	$query = "SELECT * FROM transaction where customerID='$boughtid'";
	$result = $conn->query($query);
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	$rows = $result->num_rows;
	while ($row = $result->fetch_assoc()) {
			
		$q[]= $row['source'];
		foreach($q as $value)
		{
			$value=strtolower(substr($value, 0, -4));
			
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

	$query = "SELECT * FROM transaction WHERE category like '$category' and customerID='$boughtid'";
	$result = $conn->query($query);
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";	
	$rows = $result->num_rows;
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
<form action="cart.php" method="post">
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
	}
	
	//echo $category;
	 if(in_array($category, $test)!==false)
	{
		//echo $category;
		echo "</br>";
		echo $val;
	echo "yes";
	$query = "SELECT * from transaction where LOWER(substr(source from 1 for char_length(source)-4)) like LOWER('$category') and customerID='$boughtid'";
	$result = $conn->query($query);
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";	
	$rows = $result->num_rows;
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