<?php

include_once('../cfg/cdns.php');
session_start();




function addKarmaButton($user){
		
		echo "
	<button type='button' id='addKarmaButton' class='btn btn-success btn-sm ms-1 rounded' onclick='addKarma()'>+</button>


	<script>

	function addKarma(){
		$.ajax({
			url: '/func/addKarmaToUser.php', //the page containing php script
			type: 'POST', //request type
			data: {
				u: '" . $user . "',
			},
		success:function(data){
					var newKarma = parseInt($('#karma').html()) + 2;
					$('#karma').html('' + newKarma);
				}
	});
	}

	</script>";
		
	
	
}

?>

