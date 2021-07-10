<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');

function addKarmaButton($user){

		echo "
	<button type='button' title='Add karma to this user!' id='addKarmaButton' class='badge bg-success ms-1 no-border' onclick='addKarma()'>+</button>


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


function removeKarmaButton($user){

		echo "
	<button type='button' title='Remove karma to this user!' id='removeKarmaButton' class='badge bg-danger ms-1 no-border' onclick='remKarma()'>-</button>


	<script>

	function remKarma(){
		$.ajax({
			url: '/func/remKarmaFromUser.php', //the page containing php script
			type: 'POST', //request type
			data: {
				u: '" . $user . "',
			},
		success:function(data){
					var newKarma = parseInt($('#karma').html()) - 2;
					$('#karma').html('' + newKarma);
				}
	});
	}

	</script>";



}

?>
