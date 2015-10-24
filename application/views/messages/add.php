<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

if (is_numeric($originalMessageID) && $originalMessageID > 0)
{
	$cancelURL = URL_WITH_INDEX_FILE . "messages/view/" . $originalMessageID;

	if (strcasecmp($message->Recipient_ID, $userID) == 0)
	{
		$recipientID = $message->Sender_ID;
	}
	else if (strcasecmp($message->Sender_ID, $userID) == 0)
	{
		$recipientID = $message->Recipient_ID;
	}

	$title = "RE: " . $message->Title;
}
else
{
	$cancelURL = URL_WITH_INDEX_FILE . "messages";
	$title = "";
}
?>

<div class="container">
	<h2 class="page-header">New Message</h2>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>messages/save" class="form-horizontal">
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<div class="form-group">
			<label for="recipientID" class="col-sm-2 control-label">Recipient</label>
			<div class="col-sm-10">
				<select id="recipientID" name="recipientID" class="form-control" required aria-required="true">
					<option value="">&nbsp;</option>
					<?php foreach ($recipients as $recipient) { ?>
						<option value="<?php echo $recipient->ID; ?>" <?php if (strcasecmp($recipientID, $recipient->ID) == 0) { ?>selected<?php } ?>><?php echo $recipient->First_Name . " " . $recipient->Last_Name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">Title</label>
			<div class="col-sm-10">
				<input type="text" id="title" name="title" value="<?php echo $title ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
			<label for="content" class="col-sm-2 control-label">Content</label>
			<div class="col-sm-10">
				<textarea id="content" name="content" class="form-control" rows="5" required aria-required="true"></textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="cancel" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-default">Save</button>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo $cancelURL; ?>';
		});

		$('#form').validate({});
	});
</script>