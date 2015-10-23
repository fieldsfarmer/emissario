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
	<h4>New Message</h4>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>messages/save" class="col s12" novalidate="novalidate">
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<div class="row">
			<div class="input-field col s12">
				<select id="recipientID" name="recipientID" class="validate" required aria-required="true">
					<option value=""></option>
					<?php foreach ($recipients as $recipient) { ?>
						<option value="<?php echo $recipient->ID; ?>" <?php if (strcasecmp($recipientID, $recipient->ID) == 0) { ?>selected<?php } ?>><?php echo $recipient->First_Name . " " . $recipient->Last_Name; ?></option>
					<?php } ?>
				</select>
				<label for="recipientID">Recipient</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="title" name="title" value="<?php echo $title ?>" placeholder="" />
				<label for="title">Title</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<textarea id="content" name="content" class="materialize-textarea validate" required aria-required="true" placeholder=""></textarea>
				<label for="content">Content</label>
			</div>
		</div>

		<a id="cancel" class="btn waves-effect waves-light">Cancel</a>
		<button type="submit" class="btn waves-effect waves-light" name="action">Save</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo $cancelURL; ?>';
		});

		$('select').material_select();

		$('#form').validate({});
	});
</script>