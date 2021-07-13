    <?php
	include_once('../cfg/cdns.php');


	if (isset($_POST['game'])) {

  		$output = "";
  		$gameL = $_POST['game'];
  		$query = "SELECT * FROM games WHERE name LIKE '%$gameL%' OR shortName LIKE '%$gameL%' ORDER BY CASE
			WHEN name LIKE '$gameL' THEN 1
			WHEN name LIKE '$gameL%' THEN 2
			WHEN name like '%$gameL' THEN 4
			ELSE 3
			END
		LIMIT 3";
  		$result = $conn->query($query);
		$gameIds = [];

  		$output = '<ul class="list-unstyled">';

  		if ($result->num_rows > 0) {
  			while ($row = $result->fetch_array()) {
				$gameNameL = $row['name'];
  				$output .= '<li name="g" id="goToGame" href="/lfg?g=' . ucwords($row['name']) . '" class="listitem dark-box sm-text"><img class="icon-sm me-1" src="' . $row['sm_icon'] . '"></img><a id="gameNameB">'.ucwords($row['name']).'</a></li>';
  			}
  		}else{
  			  $output .= '<li class="listitem dark-box"> Game not in database!</li>';
  		}

	  	$output .= '</ul>';
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
