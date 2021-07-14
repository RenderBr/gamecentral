<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');


	if(isset($_GET['p']) && !isset($_GET['g'])){
		$goToPage = $_SERVER['REQUEST_URI'] . "&g=";
	}

	if(isset($_GET['g'])){
		$goToPage = strtok($_SERVER["REQUEST_URI"], '?');
		$goToPage = $goToPage . "?g=";
}

?>
			<div class="form-group">
				<form style='margin-bottom:0px !important;' method="GET" action='/lfg'>
					<div class="auto-widget">
					<form class='form-group'>
						<div class="row">
							<div class="col">
							  	<input placeholder="GAME FILTER" autocomplete="off" class="dark-box form-control" id="gameSearch" type="text" name="g"/>
								<div id='gameList'></div>
							</div>
					</form>
					</div>
				</form>
			</div>


<script type="text/javascript">
  $(document).ready(function(){
      $("#gameSearch").on("keyup", function(){
        var game = $(this).val();
        if (game !=="") {
          $.ajax({
            url:"/func/gameServerSearch.php",
            type:"POST",
            cache:false,
            data:{game:game},
            success:function(data){
              $("#gameList").html(data);
              $("#gameList").fadeIn();
            }
          });
        }else{
          $("#gameList").html("");
          $("#gameList").fadeOut();
        }
      });

      // click one particular city name it's fill in textbox
      $(document).on("click","#goToGame", function(){
        $('#gameSearch').val($(this).text());
        $('#gameList').fadeOut("fast");
				window.location.replace("<?php echo $goToPage; ?>" + $(this).text());
      });
  });
</script>
