<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		include_once('cfg/cdns.php');
		$news = $_GET['n'];

		$sql = "SELECT * FROM blogs WHERE id = '$news'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
				$newsTitle = $row['title'];
				$newsAuthor = $row['author'];
				$newsContent = $row['content'];
				$newsImage = $row['img'];
				$newsDatePublished = $row['date_created'];
				$newsTags = $row['tags'];
        $approved = $row['approved'];
        if($approved == 0){
          $approved = " - TO BE APPROVED BY ADMIN";
        }else{
          $approved = NULL;
        }
		  }
		}else{
			header("Location: /");
		}

		?>
		<meta name="description" content="<?php echo htmlspecialchars($newsContent); ?>">
		<meta name="keywords" content="<?php echo $newsTags; ?>">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<meta property="og:image" content="<?php echo $newsImage; ?>">
		<title><?php echo $websitename . " - " . $newsTitle; ?></title>
		<meta name="title" content="GameCentral - <?php echo $newsTitle; ?>">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class='bg-dark3'>
	<?php include_once('modules/navbar.php'); ?>

		<br><div class='bg-dark1 container news rounded mb-4 pb-3'>
		<div class='text-center'>
			<h2 class='mt-2'><?php echo $newsTitle; ?></h2>
			<hr class='nav-break'>
			<label style='text-align:none !important;'>
				<p class="sm-text noselect">AUTHOR: <a class='sm-text noselect' style='color:white;text-decoration:none;' href='/user?u=<?php echo $newsAuthor; ?>'><?php echo $newsAuthor . $approved; ?></a></p>
			</label>
			<img class='img-fluid rounded img-thumbnail' src='<?php echo $newsImage; ?>'>
			<hr class='nav-break mt-2'>

		</div>
		<label>
			<p class="sm-text noselect">DATE CREATED: <?php echo $newsDatePublished; ?></p>
		</label>

		<p style='margin-bottom:0.75rem !important;'>
			<?php echo $newsContent; ?>
      <hr class='nav-break mt-2' style='margin-bottom: 0.3rem !important;'>
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8564713175090072"
     crossorigin="anonymous"></script>
<!-- DisplayAd -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8564713175090072"
     data-ad-slot="7188111027"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
		</p>


		</div>
			<?php


			?>
			</div>

		</div>


    </body>
</html>

<script>

	function getColor(value){
		//value from 0 to 1
		var hue=(value*100).toString(10);
		return ["hsl(",hue,",100%,50%)"].join("");
	}

	var kv = parseInt($('#karma').text())
	var value = kv / 1000;
	$('#karma').attr("style", "color: " + getColor(value) + " !important");
	$('#karma2').attr("style", "color: " + getColor(value) + " !important");

	$('#discord').click(function () { copyToClipboard("<?php echo $usersDiscord; ?>"); });

	function copyToClipboard(text) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(text).select();
		document.execCommand("copy");
		$temp.remove();
}

</script>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}

.box {
   display: flex;
   align-items:center;
}
</style>
<?php
	$conn->close();
?>
