<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Messages</h2>
	<button type="button" id="send" class="btn btn-default">Send a Message</button>
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
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/add"; ?>';
		});
	});
</script>