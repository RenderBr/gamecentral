<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');

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
