<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

	//search 
require_once('authenticate.php');

$_SESSION["tmpid"]="";
$tmp= $_SESSION["user"];
$p= $_SESSION["pass"];

$query = "SELECT id from customer where userName='$tmp' and password='$p'";
	$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
			//echo "Welcome ".$tmp." , id: ".$row['id']."<br>";
			$_SESSION["tmpid"]=$row['id'];
			}
	if (!$result) echo "SELECT failed: $query<br>" . $conn->error . "<br><br>";
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

// test if connection is successful . MAMAMIA

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
	//echo $newname;
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


//from sqltest example provided by professor
// show the image database on webpage
			function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);
			}	
			
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<a class="navbar-brand" href="#">Giggity</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		 </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="startScreen.php">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="ImageTest.php">Upload</a>
		      </li>
		       <li class="nav-item">
		        <a class="nav-link" href="ItemsBought.php">Purchases</a>
		      </li>
		      <form class="form-inline my-2 my-lg-0 ml-5">
			      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		      </form>
		      <li class="nav-item mr-5" style="position: absolute; right: 0">
		      	<div class="dropdown">
		      		<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome, <?= $tmp ?>
		      		</button>
		      		<div class="dropdown-menu">
					    <a class="dropdown-item" href="cart.php">Cart</a>
					    <a class="dropdown-item" href="ItemsBought.php">Purchases</a>
					    <a class="dropdown-item" href="ImageTest.php">Upload</a>
					    <div class="dropdown-divider"></div>
					    <a class="dropdown-item" href="logout.php">Logout</a>
					</div>
		      	</div>
		      </li>
		    </ul>
		  </div>
	</nav>
	<div class="container-fluid ml-5">
		<div class="row">
			<form action="search.php" method="post">
				<input type="hidden" name="choose" value="yes">
				<button class="btn btn-outline-success mt-2" type="submit">Browse Images</button>
			</form>
		</div>
		<div class="row">
			<form method="post" action="" enctype='multipart/form-data'>
				<label class="btn btn-outline-success btn-file mt-2">
				    Select Image<input type="file" style="display: none;">
				</label><br>
				Category<input class="ml-2" type="text" name="category">
				<button class="btn btn-outline-success" type='submit' name='image_upload'>Upload</button>
			</form>
		</div>
		<div class="row">
			<?php
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

<div class="column ml-2 mb-5" style=float:left;padding:10 10 10 10>
	<div class="card" style="width: 15rem;">
	  <img class="card-img-top" src= $row[3] alt="HTML5 Icon">
	  <div class="card-body">
	    <h5 class="card-title">$row[3]</h5>
	    <p class="card-text">id: $row[0]</p>
	    <p class="card-text">resolution: $row[1]</p>
	    <p class="card-text">size: $row[2]</p>
	    <p class="card-text">category: $row[4]</p>
	    <form class = "" action="ImageTest.php" method="post">
			<input type="hidden" name="delete" value="yes">
			<input type="hidden" name="id" value="$row[0]">
			<button class = "btn btn-outline-success" type="submit">Delete</button>
		</form>
		<form class = "mt-2" action="ImageTest.php" method="post">
			<input type="hidden" name="choose" value="yes">
			<input type="hidden" name="id" value="$row[0]">
			<button class = "btn btn-outline-success" type="submit">Add to Cart</button>
		</form>
	  </div>
	</div>


</div>

_END;

			}	
			$result->close();
			$conn->close();	
			?>
		</div>
	</div>
</body>
<footer>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</footer>
</html>