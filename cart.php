<?php
session_start();
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$buyid= $_SESSION["tmpid"];
echo $buyid;
/*
if (isset($_POST['delete']) && isset($_POST['id']))
{
	echo"kjjh";
	$id = get_post($conn, 'id');
	$query = "DELETE FROM cart WHERE id='$id'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	}
	*/

//delete from cart
if (isset($_POST['delete']) && isset($_POST['id']) && isset($_POST['res']) && isset($_POST['size']) && isset($_POST['source']) && isset($_POST['category']))
{
	echo "hi";
	$id = get_post($conn, 'id');
	$res = get_post($conn, 'res');
	$size = get_post($conn, 'size');
	$name = get_post($conn, 'source');
		$cat = get_post($conn, 'category');
	
	$query = "INSERT INTO music VALUES('$id','$res','$size','$name','$cat')";
	$result = $conn->query($query);
	if (!$result) die("Database access failed: ". $conn->error);
	
	$query = "DELETE FROM cart WHERE id='$id'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	}

	if (isset($_POST['buy']) && isset($_POST['id']))
{
	$imageid = get_post($conn, 'id');
	//echo $imageid;
	
	$query ="SELECT * FROM cart";
		$result = $conn->query($query);
		
		while ($row = $result->fetch_assoc()) {
		$s[]=$row['id'];	
		print_r ($s);
		
	}
		if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
		
	$query = "SELECT id from customer where id='$buyid'";
	$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
			//echo "Welcome ".$tmp." , id: ".$row['id']."<br>";
			$ti=$row['id'];
			}
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
		foreach ($s as $k => $v) {
    $query ="INSERT INTO transaction VALUES(NULL,'$ti','$v',CURDATE())";
	$result = $conn->query($query);
	if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
}

	
	$query = "DELETE FROM cart";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	
	}
echo <<<_END
<form action="cart.php" method="post">
<input type="hidden" name="id" value="">
<input type="hidden" name="buy" value="yes">
<input type="submit" value="BUY">
</form>
_END;

echo <<<_END
<form action="startScreen.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="Home">
</form>
_END;


 $query ="SELECT * FROM cart";
		$result = $conn->query($query);
		if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
		echo "Cart: ";
		echo "</br>";
		while ($row = $result->fetch_assoc()) {
			
		$q= $row['id'];
		$t=$row['resolution'];
		$u=$row['size'];
		$v=$row['source'];
	}

	
	$query = "SELECT * FROM cart";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
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
source $row[3]
category: $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">
</pre>

<form action="cart.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="hidden" name="res" value="$row[1]">
<input type="hidden" name="size" value="$row[2]">
<input type="hidden" name="source" value="$row[3]">
<input type="hidden" name="category" value="$row[4]">

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