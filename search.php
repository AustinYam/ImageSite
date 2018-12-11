<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

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
	//$query = "SELECT * FROM music WHERE category='$category'";
	$query = "SELECT * FROM music";
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

	$query = "SELECT * FROM music WHERE category like '$category'";
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
id $row[0]
resolution $row[1]
size $row[2]
source $row[3]
category $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">

</pre>
<form action="ImageTest.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="DELETE RECORD">
</form>
<form action="ImageTest.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="CHOOSE RECORD">
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
	$query = "SELECT * from music where LOWER(substr(source from 1 for char_length(source)-4)) = LOWER('$category')";
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
id $row[0]
resolution $row[1]
size $row[2]
source $row[3]
category $row[4]
<img src= $row[3] alt="HTML5 Icon" style="width:128px;height:128px">

</pre>

<form action="ImageTest.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="DELETE RECORD">
</form>
<form action="ImageTest.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="CHOOSE RECORD">
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