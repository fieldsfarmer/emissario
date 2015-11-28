<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

if (is_numeric($originalMessageID) && $originalMessageID > 0)
{
	$cancelURL = URL_WITH_INDEX_FILE . "messages/view/" . $originalMessageID;

	$recipientName = "";
	$lockRecipient = true;
	if (strcasecmp($originalMessage->Recipient_ID, $userID) == 0)
	{
		$recipientID = $originalMessage->Sender_ID;
		$recipientName = $originalMessage->Sender_First_Name . " " . $originalMessage->Sender_Last_Name;
	}
	else if (strcasecmp($originalMessage->Sender_ID, $userID) == 0)
	{
		$recipientID = $originalMessage->Recipient_ID;
		$recipientName = $originalMessage->Recipient_First_Name . " " . $originalMessage->Recipient_Last_Name;
	}

	$wishID = $originalMessage->Wish_ID;
	$wishDescription = $originalMessage->Wish_Description;
	$wishLink = "";
	if ($originalMessage->Wish_Owner_ID == $userID) {
		$wishLabel = "Wish";
		$wishLink = URL_WITH_INDEX_FILE . "wishes/view/" . $originalMessage->Wish_ID;
	}
	elseif (is_numeric($originalMessage->Help_ID)) {
		$wishLabel = "Help";
		$wishLink = URL_WITH_INDEX_FILE . "helps/view/" . $originalMessage->Help_ID;
	}

	if (strcasecmp("RE:", $GLOBALS["beans"]->stringHelper->left($originalMessage->Title, 3)) <> 0)
	{
		$title = "RE: " . $originalMessage->Title;
	}
	else
	{
		$title = $originalMessage->Title;
	}
}
elseif (is_numeric($wishID))
{
	if (strcasecmp("Wish", $wish->Type) == 0)
	{
		$cancelURL = URL_WITH_INDEX_FILE . "wishes/view/" . $wish->Link_ID;
		$wishLink = $cancelURL;
	}
	elseif (strcasecmp("Help", $wish->Type) == 0)
	{
		$cancelURL = URL_WITH_INDEX_FILE . "helps/view/" . $wish->Link_ID;
		$wishLink = $cancelURL;
	}
	else
	{
		$cancelURL = URL_WITH_INDEX_FILE . "messages";
		$wishLink = "";
	}

	$lockRecipient = true;
	$recipientID = $wish->Valid_Recipient_ID;
	$recipientName = $wish->Valid_Recipient_First_Name . " " . $wish->Valid_Recipient_Last_Name;

	$wishID = $wish->ID;
	$wishDescription = $wish->Description;
	$wishLabel = $wish->Type;

	$title = "";
}
else
{
	$cancelURL = URL_WITH_INDEX_FILE . "messages";
	$lockRecipient = false;
	$wishLink = "";
	$title = "";
}
?>

<div class="container">
	<h2 class="page-header">New Message</h2>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>messages/save" class="form-horizontal">
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID; ?>" />

		<div class="form-group">
			<label for="recipientID" class="col-sm-2 control-label">Recipient</label>
			<div class="col-sm-10">
				<?php if ($lockRecipient) { ?>
					<p class="form-control-static"><?php echo $recipientName; ?></p>
					<input type="hidden" id="recipientID" name="recipientID" value="<?php echo $recipientID; ?>" required aria-required="true" />
				<?php } else { ?>
					<select id="recipientID" name="recipientID" class="form-control" required aria-required="true">
						<option value="">- Recipient -</option>
						<?php foreach ($friends as $friend) { ?>
							<option value="<?php echo $friend->ID; ?>" <?php if (strcasecmp($recipientID, $friend->ID) == 0) { ?>selected<?php } ?>><?php echo $friend->First_Name . " " . $friend->Last_Name; ?></option>
						<?php } ?>
					</select>
				<?php } ?>
			</div>
		</div>
		<?php if (is_numeric($wishID) && $wishLink != "") { ?>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $wishLabel; ?></label>
				<div class="col-sm-10">
					<p class="form-control-static">
						<a href="<?php echo $wishLink; ?>" target="_new">
							<?php echo $wishDescription; ?>
						</a>
					</p>
					<input type="hidden" id="wishID" name="wishID" value="<?php echo $wishID; ?>" />
				</div>
			</div>
		<?php } ?>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">Title</label>
			<div class="col-sm-10">
				<input type="text" id="title" name="title" value="<?php echo $title; ?>" class="form-control" />
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

		$('#form').validate({
			ignore: ':hidden:not(#recipientID)'
		});
	});
</script>