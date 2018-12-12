<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
/*
//search
echo <<<_END
<form action="" method="post">

<input type="text" name="enter">
search by<type="label" name="searchby">
<select>
<option name="category">category</option>
<option value="name">name</option>
<option value="size">size</option>
</select>
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
	echo $category;
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
	print_r($t);
	print_r($test);
	echo $category;
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
<pre>
id $row[0]
resolution $row[1]
size $row[2]
source $row[3]
category $row[4]
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
_END;
			}		
	}
	
	echo $category;
	 if(in_array($category, $test)!==false)
	{
		echo $category;
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
<pre>
id $row[0]
resolution $row[1]
size $row[2]
source $row[3]
category $row[4]
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
_END;
			}		
	}
			
	}
	*/
	//search 
echo <<<_END
<form action="search.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="search images">
</form>
_END;


//from sqltest example provided by professor
//delete from database
if (isset($_POST['delete']) && isset($_POST['id']))
{
	$id = get_post($conn, 'id');
	$query = "DELETE FROM music WHERE id='$id'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	}
	
	//choose image into cart
	if (isset($_POST['choose']) && isset($_POST['id']))
{
	$id = get_post($conn, 'id');
	$query = "SELECT * FROM music WHERE id='$id'";
	$result = $conn->query($query);
	
	while ($row = $result->fetch_assoc()) {
		$s=$row['id'];	
		$t=$row['resolution'];
		$u=$row['size'];
		$v=$row['source'];
		$w=$row['category'];
	}
	 $query ="INSERT INTO cart VALUES('$s','$t','$u','$v','$w')";
		$result = $conn->query($query);
		if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
		
		$query = "DELETE FROM music WHERE id='$s'";
	$result = $conn->query($query);
	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";

	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
	}
	
//display cart
echo <<<_END
<form action="cart.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="CART">
</form>
_END;

// test if connection is successful . MAMAMIA
echo "Mamamia my Music database". '<br>'. '<br>';

// upload image and insert into Database
if(isset($_POST['image_upload']) && isset($_POST['category'])){

 
 //get the image file ( from php website)
 $name = $_FILES['file']['name'];
 $size=$_FILES['file']['size'];
 $filepath= "images/".$name;
 //echo $name;
 
 
 // the target directory
 $target_dir = "upload/";
 $target_file = $target_dir . basename($_FILES["file"]["name"]);

 // file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // check for file extensions to make sure it is an image file
 $extensions_arr = array("jpg","jpeg","png","gif");
 
 //get size and convert into kb or mb
 $size = $_FILES['file']['size'];
	//(size info from php file sizes)
        if ($size >= 1048576)
        {
            $size = number_format($size / 1048576, 2) . ' MB';
        }
        elseif ($size >= 1024)
        {
            $size = number_format($size / 1024, 2) . ' KB';
        }
        elseif ($size > 1)
        {
            $size = $size . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $size = $size . ' byte';
        }
        else
        {
            $size = '0 bytes';
        }
 
 //get resolution
$tmpName = $_FILES['file']['tmp_name'];        
list($width, $height, $type, $attr) = getimagesize($tmpName);
$res= "$width" . 'x' . "$height";
$newwidth = $width/2; 
$newheight = $height/2;

 // Check extension
 if( in_array($imageFileType,$extensions_arr) ){
	$category = get_post($conn, 'category');
	
	//water mark
	
	$image= imagecreatefromjpeg($name);
	$foreground = imagecreatefrompng("watermark.png");
	$tmpnewname=substr($name, 0, -4);
	$newname=$tmpnewname."new.png";
	echo $newname;
	//save alpha channel information ( from php website)
	imagesavealpha($foreground, true); 
	
	//set blending mode for alpha image
	imagealphablending($foreground, true);    //from php website
	
	
	//copy images by setting coordinates width and height 
	imagecopy($image, $foreground, $width/2, $height/2, 0,0 , $width,$height);  //from php website
	imagepng($image,$newname);
 
  // Insert record
 $query = "insert into music values(NULL,'$res','$size','$newname','$category')";
 $result = $conn->query($query);
if (!$result) die("Database access failed: ". $conn->error);

  // Upload file (from php website)
  move_uploaded_file($_FILES['file']['name'],$target_dir.$name);

}
}
echo <<<_END
<form method="post" action="" enctype='multipart/form-data'>
<input type='file' name='file' /></br>
category<input type="text" name="category">
<input type='submit' value='Save' name='image_upload'>
</form>
_END;

//log out
echo <<<_END
<form action="loginPage.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="LOG OUT">
</form>
_END;

//items bought
echo <<<_END
<form action="ItemsBought.php" method="post">
<input type="hidden" name="choose" value="yes">
<input type="submit" value="ITEMS BOUGHT">
</form>
_END;

//from sqltest example provided by professor
// show the image database on webpage
$query = "SELECT * FROM music";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		$rows = $result->num_rows;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
			$g=$row[3];
			//echo '<img src="'.$g.'" alt="HTML5 Icon" style="width:128px;height:128px">';
echo <<<_END

<div class=column style=float:left;padding:10 10 10 10>
<pre>
id: $row[0]
resolution: $row[1]
size: $row[2]
source: $row[3]
category: $row[4]
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
			$result->close();
			$conn->close();
			function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);
			}	
			
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>