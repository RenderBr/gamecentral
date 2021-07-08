
<div id="page-wrap">

    <p id="name-area"></p>

    <div id="chat-wrap"><div id='chat-area' data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" tabindex="0" style='height:20rem;background-color: #343535;' class="container dark-box overflow-scroll">



</div>
</div>
    <form id="chatBox">
		<label for='msg'><p class='sm-text noselect mt-2'>MESSAGE </p></label>
		<div class="input-group">
        <textarea class='dark-box form-control' name='msg' id="sendie"></textarea>
		<input name='groupid' value='<?php echo $id; ?>' style='display:none;'></input>
	  </form>
		<a type='button' onclick='send()' class='btn btn-success mt-1 ms-1'>Send!</a>
	</div>


</div>

</body>


<script>
    $(document).ready(function(){
      loadChat();
    });

    var element = document.getElementById("chat-area");
    var text = $('#sendie');
    var refresh;

    function loadChat(){
        $('#chat-area').load('/modules/getChat.php?g=<?php echo $id; ?>', function(){
			element.scrollTop = element.scrollHeight;
           refresh = setTimeout(loadChat, 5000);
        });
    }

function send(){
	if(text.val() == ""){
		loadChat();
	}else{
		$.get('https://gamecentral.online/func/processMsg.php?' + $('#chatBox').serialize());
		$('#sendie').val('');
		loadChat();
	}
}
</script>
