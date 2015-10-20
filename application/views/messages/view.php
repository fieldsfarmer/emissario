<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Message </h4>
	<h5><?php echo $messages[0]->Title ?>
		<?php echo $messages[0]->Created_On ?></h5>
	<h5><?php echo $messages[0]->Content ?></h5>
	<h5><?php echo $messages[0]->First_name ?></h5>							
<a id="reply" class="btn waves-effect waves-light">reply</a>	
						
</div>


<script>
	$(document).ready(function(){
		$('#reply').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/edit"; ?>';
		});
	});
</script>
