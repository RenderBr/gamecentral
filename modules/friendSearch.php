<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');


?>
			<div class="form-group">
				<form method="GET" action='/lfg' style='margin:0px !important;'>
					<div class="auto-widget">
						<div class="row">
					<form class='form-group'>
							<div class="col">
							  	<input placeholder="SEARCH FOR USERNAME" autocomplete="off" class="dark-box form-control" id="userSearch" type="text" name="u"/>
								<div id='userList'></div>
								</div>
					</form>


					</div>
				</form>
			</div>


<script type="text/javascript">
  $(document).ready(function(){
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
      $(document).on("click","#goToUser", function(){
        $('#userSearch').val($(this).text());
        $('#userList').fadeOut("fast");
				window.location.replace("/user?u=" + $(this).text());
      });

  });
</script>
