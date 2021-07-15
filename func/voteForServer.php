<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');


if(isset($_POST['u']) && isset($_POST['s'])){
  $user = $_POST['u'];
  $server = $_POST['s'];
}

$hasVoted = $conn->query("SELECT * from votes WHERE votingUser = '$user' AND forServer = '" . $serverId . "' AND date_created >= now() - INTERVAL 1 DAY");
if($hasVoted->num_rows > 0){

}else{
  $conn->query("INSERT INTO votes (forServer, votingUser) VALUES
  ('$server', '$user')");
}



 ?>
