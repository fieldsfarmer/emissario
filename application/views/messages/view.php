<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Message Details</h4>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Message Date</div>
			<div class="view-details-value"><?php echo $message->Formatted_Created_On ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Sender</div>
			<div class="view-details-value"><?php echo $message->Sender_First_Name . " " . $message->Sender_Last_Name ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Recipient</div>
			<div class="view-details-value"><?php echo $message->Recipient_First_Name . " " . $message->Recipient_Last_Name ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Title</div>
			<div class="view-details-value"><?php echo $message->Title ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Content</div>
			<div class="view-details-value"><?php echo $message->Content ?></div>
		</div>
	</div>
	<a id="back" class="btn waves-effect waves-light">Back</a>
	<a id="reply" class="btn waves-effect waves-light">Reply</a>
</div>

<script>
	$(document).ready(function(){
		$('#back').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages"; ?>';
		});

		$('#reply').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/add/" . $messageID; ?>';
		});
	});
</script>
