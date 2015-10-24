<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Message Details</h2>
	<div class="section form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">Message Date</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $message->Formatted_Created_On ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Sender</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $message->Sender_First_Name . " " . $message->Sender_Last_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Recipient</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $message->Recipient_First_Name . " " . $message->Recipient_Last_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Title</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $message->Title ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Content</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $message->Content ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="back" class="btn btn-default">Back</button>
				<button type="button" id="reply" class="btn btn-default">Reply</button>
			</div>
		</div>
	</div>
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
