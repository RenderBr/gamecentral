    <?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');


	if (isset($_POST['user'])) {

  		$output = "";
  		$userL = $_POST['user'];
  		$query = "SELECT * FROM users WHERE username LIKE '%$userL%' ORDER BY CASE
			WHEN username LIKE '$userL' THEN 1
			WHEN username LIKE '$userL%' THEN 2
			WHEN username like '%$userL' THEN 4
			ELSE 3
			END
		LIMIT 3";
  		$result = $conn->query($query);
		$userIds = [];

  		$output = '<ul class="list-unstyled">';

  		if ($result->num_rows > 0) {
  			while ($row = $result->fetch_array()) {
  				$output .= '<li name="u" id="goToUser" value="' . ucwords($row['username']) . '" href="/lfg?g=' . ucwords($row['username']) . '" class="listitem dark-box sm-text"><img class="icon-sm me-1 rounded-circle" src="' . $row['avatar'] . '"></img><a id="userNameB">'.ucwords($row['username']).'</a></li>';
  			}
  		}else{
  			  $output .= '<li class="listitem dark-box"> User not in database!</li>';
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

	<script>

	$("#goToUser").click(function(){
		window.location.href="lfg?u=" + $("#userNameB").html();
	});

	</script>
