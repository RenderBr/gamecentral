<?php
echo "<a style='display:none;'>Friend module loaded successfully.</a>";
session_start();
include_once('../cfg/cdns.php');
$self = $_SESSION['username'];
if(!$self){
	header("Location: /");
}
$friend = $_GET['u'];
$friendcombo = $self . " - " . $friend;
$friendcombo2 = $friend . " - " . $self;
if($self == $friend){
	
}else {
	
	
	$sql = "SELECT * FROM friends WHERE friendCombo = '$friendcombo'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {	

		while($row = $result->fetch_assoc()) {
			$accepted = $row['accepted'];
			if($accepted == 1){
				echo "<button id='rem' onclick='removeFriend()' title='Remove friend!' class='btn btn-danger'><i class='bi bi-person-x'></i></button><br>";
			}else{
				echo "<button title='Friend request pending!' class='btn btn-secondary'>Request pending...</button><br>";
			}
			
			
		}
	}else{
		
	$sql = "SELECT * FROM friends WHERE friendCombo = '$friendcombo2'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {	

		while($row = $result->fetch_assoc()) {
			$accepted = $row['accepted'];
			if($accepted == 1){
				echo "<button id='rem' onclick='removeFriend()' title='Remove friend!' class='btn btn-danger'><i class='bi bi-person-x'></i></button><br>";
			}else{
				echo "<button id='acceptF' onclick='acceptFriend()' title='Friend request pending!' class='btn btn-secondary'>Accept request!</button><br>";
			}
			
			
		}
	}else{
		echo "<button id='addF' onclick='addFriend()' title='Add friend!' class='btn btn-success'><i class='bi bi-person-plus'></i></button><br>";
	}
		
	}
	
	
	
	
}

?>

<script>

function removeFriend(){
	$.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: "<?php echo $friend; ?>",
					self: "<?php echo $self; ?>",
					action: "remove"
				},
                success: function(data) {	
					$("#rem").html("Removed!");
                }
            });
}

function addFriend(){
	        $.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: "<?php echo $friend; ?>",
					self: "<?php echo $self; ?>",
					action: "add"
				},
                success: function(data) {	
					$("#addF").html("Requested!");
					$("#addF").removeClass("btn-danger");
					$("#addF").addClass("btn-secondary");
                }
            });
}

function acceptFriend(){
	        $.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: "<?php echo $friend; ?>",
					self: "<?php echo $self; ?>",
					action: "accept"
				},
                success: function(data) {	
					$("#acceptF").html("Accepted!");
					$("#acceptF").removeClass("btn-secondary");
					$("#acceptF").addClass("btn-success");
                }
            });
}
   
</script>