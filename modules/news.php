<label><p class="sm-text noselect" title='Official news from the Game Central Team. These may contain updates about the site, announcements, giveaways, and so much more. Always make sure to keep watch of this!'>NEWS, UPDATES, & INFO</p></label>


<div class='container bg-dark2' style='max-width:98%;height:max-content;margin-top:10px;padding: 15px 0 15px 0px;border-radius: 10px;'><div class='px-2'><div class='row g-1'>
<?php 

include_once('.../cfg/cdns.php');
$servername = "localhost";
$username = "2admin";
$password = "Wv9bGBaolonxw98w";
$dbname = "gamecentral";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 


$sql6 = "SELECT * FROM blogs";
$result6 = $conn->query($sql6);

if ($result6->num_rows > 0) {	

  while($row6 = $result6->fetch_assoc()) {
	   
	  $newsId = $row6['id'];
	  $title = $row6['title'];
	  $content = $row6['content'];
	  $author = $row6['author'];
	  $image = $row6['img'];
	  $tagLine = $row6['tagline'];
	  
		echo '<div class="col-sm-3 ">
				<div class="p-3 bg-darkest rounded"><a style="color:white;" href="/news?n=' . $newsId . '"><img class="img-fluid img-thumbnail" src="' . $image . '"><h3>' . $title . ' </a><p class="sm-text">by <a style="text-decoration:none;color:white;" href="/user?u=' . $author . '">' . $author . '</a></p></h3><hr class="nav-break"><p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"><a>' . $tagLine . '</a></p></div>
			</div>';
		

		

  }
} else {
	echo "
	
	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No news to be displayed!</a>
    </div>
	
	";
}

$conn->close();


?>

</div>
</div>
</div>
<style>
.border{
	border:1px solid #dee2e6 !important;
}
.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */

  display: flex;
  align-items: center;
}

a{
	text-decoration:none !important;
}
.btn:focus {
	box-shadow:none !important;
}
</style>




