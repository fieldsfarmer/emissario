<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Messages</h2>

	<div class="clearfix table-action">
		<button type="button" id="send" class="btn btn-default">Send a Message</button>
	
		<form method="post" class="form-inline table-filter pull-right">
			<div class="form-group">
				<label class="sr-only" for="messageType">Type</label>
				<select id="messageType" name="messageType" class="form-control">
					<option value="">- Type -</option>
					<option value="received" <?php if (strcasecmp("received", $messageType) == 0) { ?>selected<?php } ?>>Received</option>
					<option value="sent" <?php if (strcasecmp("sent", $messageType) == 0) { ?>selected<?php } ?>>Sent</option>
				</select>
			</div>
			<div class="form-group">
				<label class="sr-only" for="search">Search</label>
				<input type="text" id="search" name="search" value="<?php echo $search; ?>" class="form-control" placeholder="Search" />
			</div>
			<button type="submit" class="btn btn-default btn-sm">Go</button>
			<button type="button" id="clear" class="btn btn-default btn-sm">Clear</button>
		</form>
	</div>

	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Message Date</th>
					<th>Sender</th>
					<th>Recipient</th>
					<th>Title</th>
					<th>Content</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($messages as $message) { ?>
					<tr>
						<td>
							<a href="<?php echo URL_WITH_INDEX_FILE . "messages/view/" . $message->ID; ?>">
								<?php echo $message->Formatted_Created_On ?>
							</a>
						</td>
						<td><?php echo $message->Sender_First_Name . " " . $message->Sender_Last_Name ?></td>
						<td><?php echo $message->Recipient_First_Name . " " . $message->Recipient_Last_Name ?></td>
						<td><?php echo $message->Title ?></td>
						<td class="truncate"><?php echo $message->Content ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#send').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>messages/add';
		});

		$('#clear').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>messages';
		});
	});
</script>