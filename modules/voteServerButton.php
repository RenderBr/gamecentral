<?php

function voteButton($serverId, $conn){
  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];

    $hasVoted = $conn->query("SELECT * from votes WHERE votingUser = '$user' AND forServer = '" . $serverId . "' AND date_created >= now() - INTERVAL 1 DAY");
    if($hasVoted->num_rows > 0){
    }else{
      $check = '<i class="bi bi-check-circle"></i>';
      echo "<button onclick='voteForServer()' id='voteButton' class='btn btn-success ms-2' title='Voting for a server will increase its ranking on the overall server list!'>Vote!</button>


      <script>

      function voteForServer(){
        $.ajax({
          url: '/func/voteForServer.php', //the page containing php script
          type: 'POST', //request type
          data: {
            u: '" . $user . "',
            s: '" . $serverId . "',
          },
        success:function(data){
              $('#voteButton').html('" . $check . "');
              $('#voteButton').prop('onclick', null).off('click');
            }
      });
      }

      </script>";
    }


  }else{

  }
}


 ?>
