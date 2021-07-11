    <?php
	include_once('../cfg/cdns.php');
     
    	
	if (isset($_POST['game'])) {

  		$output = "";
  		$gameL = $_POST['game'];
  		$query = "SELECT * FROM games WHERE name = '$gameL'";
  		$result = $conn->query($query);

  		if ($result->num_rows > 0) {
  			while ($row = $result->fetch_array()) {
				$gameNameL = $row['name'];
				$gameMaxSize = $row['maxGroupSize'];
  			}
  		}else{
  			  $output .= 'Unexpected error occured!';
  		}
  		
				for ($x = 2; $x <= $gameMaxSize; $x++){
			 $output .= '<option value="' . $x . '">
				' . $x . '
			  </option>';
		}	
		
	  	echo $output;
	}
    ?>
	
	<style type="text/css">
    .list-unstyled{
      margin-top: 0px;
      color: #000;
    }
    .listitem{
      padding: 12px;
      cursor: pointer;
      color: black;
    }
    .listitem:hover{
      background: #f0f0f0;
    }
	</style>
	
	<script>
	
	</script>