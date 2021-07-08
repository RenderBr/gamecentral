<?php
	include_once('../cfg/cdns.php');


?>
			<div class="form-group">
				<form method="GET" action='/lfg'>
					<div class="auto-widget">
					<form class='form-group'>  
						<div class="row">
							<div class="col">
							  	<input placeholder="GAME FILTER" autocomplete="off" class="dark-box form-control" id="gameSearch" type="text" name="g"/>
								<div id='gameList'></div>
							</div>
					</form>
					<form class='form-group'>  
							<div class="col">
							  	<input placeholder="USER SEARCH" autocomplete="off" class="dark-box form-control" id="userSearch" type="text" name="u"/>
								<div id='userList'></div>
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
            url:"/func/gameSearch.php",
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
      $(document).on("click","li", function(){
        $('#gameSearch').val($(this).text());
        $('#gameList').fadeOut("fast");
      });
	  
	   $("#userSearch").on("keyup", function(){
        var user = $(this).val();
        if (user !=="") {
          $.ajax({
            url:"/func/userSearch.php",
            type:"POST",
            cache:false,
            data:{user:user},
            success:function(data){
              $("#userList").html(data);
              $("#userList").fadeIn();
            }  
          });
        }else{
          $("#userList").html("");  
          $("#userList").fadeOut();
        }
      });

      // click one particular city name it's fill in textbox
      $(document).on("click","li", function(){
        $('#userSearch').val($(this).text());
        $('#userList').fadeOut("fast");
      });
	  
  });
</script>