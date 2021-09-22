<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
  if(isset($self)){
    $feedLabel = "MY FEED";
  }else{
    $feedLabel = "WHAT'S HAPPENING ON GAME CENTRAL?";
  }
 ?>

<label><p class="sm-text noselect"><?php echo $feedLabel; ?></p></label>
<script src='https://unpkg.com/@wanoo21/countdown-time@1.2.0/dist/countdown-time.js'></script>


<div class='container-fluid bg-dark2 px-4 mt-2' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
  <div class='row gx-2'>

<?php
$noFeed = NULL;
$friendList = [];

if(isset($self)){
  $sql = "SELECT * FROM friends WHERE friendCombo LIKE '%{$self}%'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

      $friendcombo = $row['friendCombo'];
      $friendUser = str_replace($self,"",$friendcombo);
      $friendUser = str_replace(" - ","",$friendUser);

      array_push($friendList, $friendUser);
    }
  }else{
    $noFeed = true;
  }
}

$friendCount = count($friendList);

if(isset($self)){
  $friends = join("', '",$friendList);
  $sql2 = "SELECT * FROM feedPosts WHERE userProfile IN ('$friends') OR poster IN ('$friends') ORDER BY id DESC LIMIT 10";

  $result2 = $conn->query($sql2);

  if ($result2->num_rows > 0) {

    while($row2 = $result2->fetch_assoc()) {

      $poster = $row2['poster'];
      $date = $row2['date_created'];
      $timeAgo = time_elapsed_string($date);
      $messageType = $row2['messageType'];
      $userProfile = $row2['userProfile'];
      $messageContents = $row2['messageContents'];

      $sql1 = "SELECT * FROM users WHERE username = '$poster'";
      $result1 = $conn->query($sql1);

      if ($result1->num_rows > 0) {

        while($row1 = $result1->fetch_assoc()) {
            $posterAvatar = $row1['avatar'];



                  if($messageType == "text"){
                    echo "<div class='d-flex bg-darkest rounded align-items-center'>
                    <div class='p-2 me-auto align-items-center'>
                      <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
                      <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>wrote on <a href='/user?u=" . $userProfile . "' style='color:white;'>" . $userProfile . "'s profile</a> <a class='gray'>></a> " . $messageContents . "</a>
                    </div>
                    <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
              </div></div>
              <hr class='nav-break'>
                    ";
                  }

                  if($messageType == "statusUpdate"){
                    echo "<div class='d-flex bg-darkest rounded align-items-center'>
                    <div class='p-2 me-auto align-items-center'>
                      <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
                      <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>is... <a>" . $messageContents . "</a></a>
                    </div>
                    <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
              </div></div>
              <hr class='nav-break'>
                    ";
                  }

                  if($messageType == "groupCreation"){

                    $sql3 = "SELECT * FROM lfgPosts WHERE id = '$messageContents'";
                    $result3 = $conn->query($sql3);

                    if ($result3->num_rows > 0) {

                      while($row3 = $result3->fetch_assoc()) {

                        $lfgName = $row3['groupName'];

                      echo "<div class='d-flex bg-darkest rounded align-items-center'>
                      <div class='p-2 me-auto align-items-center'>
                        <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
                        <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>created a new group called... <a href='/group?g=" . $messageContents . "'>" . $lfgName . "</a></a>
                      </div>
                      <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
                </div></div>
                <hr class='nav-break'>
                    ";
                  }
                }
              }

              if($messageType == "serverCreation"){

                $sql3 = "SELECT * FROM servers WHERE id = '$messageContents'";
                $result3 = $conn->query($sql3);

                if ($result3->num_rows > 0) {

                  while($row3 = $result3->fetch_assoc()) {

                    $serverName = $row3['serverName'];
                    $serverGame = $row3['forGame'];

                  echo "<div class='d-flex bg-darkest rounded align-items-center'>
                  <div class='p-2 me-auto align-items-center'>
                    <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
                    <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>listed a new server... <a href='/server?id=" . $messageContents . "'>" . $serverName . "</a></a>
                  </div>
                  <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
              </div></div>
              <hr class='nav-break'>
                ";
              }
              }
              }

              if($messageType == "communityCreation"){

                $sql3 = "SELECT * FROM communities WHERE id = '$messageContents'";
                $result3 = $conn->query($sql3);

                if ($result3->num_rows > 0) {

                  while($row3 = $result3->fetch_assoc()) {

                    $communityName = $row3['communityName'];

                  echo "<div class='d-flex bg-darkest rounded align-items-center'>
                  <div class='p-2 me-auto align-items-center'>
                    <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
                    <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>created a new community... <a href='/community?id=" . $messageContents . "'>" . $communityName . "</a></a>
                  </div>
                  <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
              </div></div>
              <hr class='nav-break'>

                ";
              }
              }
              }



        }
      }




  		//echo "<div id='" . $groupid . "l' style='border-radius:5px;' class='container bg-darkest p-4 position-relative mt-2'><a class='sm-text noselect me-2'>#" . $groupid . "</a><a style='color:white;' href='/user?u=" . $user . "'>" . $user . " <a class='gray'>&nbsp;is looking to play</a> </a><img title='" . $gameTooltip . "' width=32 class='ms-1' src='" . $iconSm . "'></img><a class='sm-text ms-1'>" . $gameName . ",</a> <a class='gray'>with a group of <a id='" . $groupid . "n'>" . $currentGroup . "</a> / " . $groupSize . " players. " . $groupName . "<div style='transform: translate(0%, -50%) !important;' class='position-absolute top-50 end-0 translate-middle'><a class='sm-text noselect' id='" . $groupid . "t'>" . $currentGroup . "</a><a class='sm-text noselect me-3'> / " . $groupSize . "</a>";
  }
  }else{
  }
}else{
  $sql2 = "SELECT * FROM feedPosts ORDER BY date_created DESC LIMIT 5";

  $result2 = $conn->query($sql2);

  if ($result2->num_rows > 0) {

    while($row2 = $result2->fetch_assoc()) {

      $poster = $row2['poster'];
      $date = $row2['date_created'];
      $timeAgo = time_elapsed_string($date);
      $messageType = $row2['messageType'];
      $userProfile = $row2['userProfile'];
      $messageContents = $row2['messageContents'];

      $sql1 = "SELECT * FROM users WHERE username = '$poster'";
      $result1 = $conn->query($sql1);

      if ($result1->num_rows > 0) {

        while($row1 = $result1->fetch_assoc()) {
            $posterAvatar = $row1['avatar'];

        }
      }

      if($messageType == "text"){
        echo "<div class='d-flex bg-darkest rounded align-items-center'>
        <div class='p-2 me-auto align-items-center'>
          <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
          <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>wrote on <a href='/user?u=" . $userProfile . "' style='color:white;'>" . $userProfile . "'s profile</a> <a class='gray'>></a> " . $messageContents . "</a>
        </div>
        <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
  </div></div>
  <hr class='nav-break'>
        ";
      }

      if($messageType == "statusUpdate"){
        echo "<div class='d-flex bg-darkest rounded align-items-center'>
        <div class='p-2 me-auto align-items-center'>
          <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
          <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>is... <a>" . $messageContents . "</a></a>
        </div>
        <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
  </div></div>
  <hr class='nav-break'>



        ";
      }

      if($messageType == "groupCreation"){

        $sql3 = "SELECT * FROM lfgPosts WHERE id = '$messageContents'";
        $result3 = $conn->query($sql3);

        if ($result3->num_rows > 0) {

          while($row3 = $result3->fetch_assoc()) {

            $lfgName = $row3['groupName'];

          echo "<div class='d-flex bg-darkest rounded align-items-center'>
          <div class='p-2 me-auto align-items-center'>
            <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
            <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>created a new group called... <a href='/group?g=" . $messageContents . "'>" . $lfgName . "</a></a>
          </div>
          <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
    </div></div>
    <hr class='nav-break'>

        ";
      }
    }
  }

  if($messageType == "serverCreation"){

    $sql3 = "SELECT * FROM servers WHERE id = '$messageContents'";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {

      while($row3 = $result3->fetch_assoc()) {

        $serverName = $row3['serverName'];
        $serverGame = $row3['forGame'];

      echo "<div class='d-flex bg-darkest rounded align-items-center'>
      <div class='p-2 me-auto align-items-center'>
        <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
        <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>listed a new server... <a href='/server?id=" . $messageContents . "'>" . $serverName . "</a></a>
      </div>
      <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
  </div></div>
  <hr class='nav-break'>

    ";
  }
  }
  }

  if($messageType == "communityCreation"){

    $sql3 = "SELECT * FROM communities WHERE id = '$messageContents'";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {

      while($row3 = $result3->fetch_assoc()) {

        $communityName = $row3['communityName'];

      echo "<div class='d-flex bg-darkest rounded align-items-center'>
      <div class='p-2 me-auto align-items-center'>
        <img title='" . $poster . "' width=32 height=32 class='ms-1 rounded-circle me-1' src='" . $posterAvatar . "'></img>
        <a style='color:white;' href='/user?u=" . $poster . "'>" . $poster . " <a class='gray'>created a new community... <a href='/community?id=" . $messageContents . "'>" . $communityName . "</a></a>
      </div>
      <div class='align-self-center'><a class='sm-text noselect me-2'  style='vertical-align: text-bottom !important;'>" . $timeAgo . "</a>
  </div></div>
  <hr class='nav-break'>

    ";
  }
  }
  }



  		//echo "<div id='" . $groupid . "l' style='border-radius:5px;' class='container bg-darkest p-4 position-relative mt-2'><a class='sm-text noselect me-2'>#" . $groupid . "</a><a style='color:white;' href='/user?u=" . $user . "'>" . $user . " <a class='gray'>&nbsp;is looking to play</a> </a><img title='" . $gameTooltip . "' width=32 class='ms-1' src='" . $iconSm . "'></img><a class='sm-text ms-1'>" . $gameName . ",</a> <a class='gray'>with a group of <a id='" . $groupid . "n'>" . $currentGroup . "</a> / " . $groupSize . " players. " . $groupName . "<div style='transform: translate(0%, -50%) !important;' class='position-absolute top-50 end-0 translate-middle'><a class='sm-text noselect' id='" . $groupid . "t'>" . $currentGroup . "</a><a class='sm-text noselect me-3'> / " . $groupSize . "</a>";
  }
  }else{
    $noFeed = true;
  }
}




if($noFeed == true){
  echo "

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No feed posts to be displayed! Please contact the developers on Discord regarding this issue.</a>
    </div>

	";
}


?>
</div>
</div>
<style>
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


<script>

function joinGroup (button) {
      $.ajax({
        url: "/func/joinGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Leave!");
			$(button).attr("onclick", "leaveGroup(this)");
			$(button).removeClass("btn-success");
			$(button).addClass("btn-danger");
			var groupid = $(button).val();
			var n = document.getElementById('' + groupid + 'n');
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(n.textContent);
			$(button).before('<a id="gpage' + groupid + '" class="btn btn-secondary me-2" href="/group?g=' + groupid + '">Open Group Page</a>');

			n.textContent = currentPlayers + 1 + "";
			t.textContent = currentPlayers + 1 + "";

			}
     });
 }

 function leaveGroup (button) {
      $.ajax({
        url: "/func/leaveGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Join group!");
			$(button).attr("onclick", "joinGroup(this)");
			$(button).removeClass("btn-danger");
			$(button).addClass("btn-success");
			var groupid = $(button).val();
			var n = document.getElementById('' + groupid + 'n');
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(n.textContent);
			$("#gpage" + groupid).remove();

			n.textContent = currentPlayers - 1 + "";
			t.textContent = currentPlayers - 1 + "";

       }
     });
 }

  function deleteGroup (button) {
      $.ajax({
        url: "/func/deleteGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			gid:$(button).val()
		},
		success:function(data){
			var groupid = $(button).val();
			$('#' + groupid + 'l').empty();
			$('#' + groupid + 'l').remove();


       }
     });
 }

</script>

<hr class='nav-break mt-2'>
