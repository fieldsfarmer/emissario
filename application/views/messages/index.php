<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Messages</h4>
	<a id="add" class="btn waves-effect waves-light">Add a Message</a>
	<table class="striped">
		<thead>
			<tr>
				<th>Messages title</th>
				<th>Content</th>
				<th>Sender name</th>
				<th>Create time</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($messages as $message) { ?>
				<tr>
					<td>
						<?php echo $message->Title ?></td>
					</td>
					<td class="truncate">
						<?php echo $message->Content ?></td>
					<td ><a href="<?php echo URL_WITH_INDEX_FILE . "messages/view/" . $message->ID; ?>">
							<?php echo $message->First_name ?>
					</a></td>
					<td >
						<?php echo $message->Created_On ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('#add').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/edit"; ?>';
		});
	});
</script>