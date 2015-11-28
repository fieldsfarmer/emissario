<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Wish Details</h2>
	<div class="section form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $wish->Description ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Destination City</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $wish->Destination_City ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Destination Country</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $wish->Destination_Country_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Status</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $wish->Status ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Weight</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $wish->Weight ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Max Date</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $wish->Formatted_Max_Date ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Compensation</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $wish->Compensation ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="back" class="btn btn-default">Back</button>
				<?php if (strcasecmp("Open", $wish->Status) == 0) { ?>
					<button type="button" id="edit" class="btn btn-default">Edit</button>
					<button type="button" id="delete" class="btn btn-default">Delete</button>
				<?php } elseif (strcasecmp("Accepted", $wish->Status) == 0) { ?>
					<button type="button" id="close" class="btn btn-default">Close</button>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="section">
		<h3 class="page-header">Helps</h3>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th width="1%">&nbsp;</th>
						<th>Helper</th>
						<th>
							Status
							<a id="statusInfo" tabindex="0" role="button" data-toggle="popover" class="info-button">
								<i class="glyphicon glyphicon-info-sign"></i>
							</a>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($helps as $help) { ?>
						<tr>
							<td width="1%" class="column-action">
								<span title="Send a Message" data-userID="<?php echo $help->User_ID; ?>" data-wishID="<?php echo $help->Wish_ID; ?>">
									<i class="glyphicon glyphicon-envelope"></i>
								</span>
							</td>
							<td><?php echo $help->Helper_First_Name . " " . $help->Helper_Last_Name ?></td>
							<td>
								<?php if ($help->Requested == 1 && $help->Offered == 1) {
									echo "Accepted";
								}
								else if ($help->Requested == 1) {
									echo "Requested";
								}
								else if ($help->Offered == 1) {
									echo "Offered";
								} ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="section">
		<h3 class="page-header">Messages</h3>
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
</div>

<script>
	$(document).ready(function(){
		$('#back').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>wishes';
		});

		<?php if (strcasecmp("Open", $wish->Status) == 0) { ?>
			$('#edit').click(function(){
				window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes/edit/" . $wishID; ?>';
			});

			$('#delete').click(function(){
				if (confirm('Are you sure you want to delete this wish?'))
				{
					window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes/delete/" . $wishID; ?>';
				}
			});

		<?php } elseif (strcasecmp("Accepted", $wish->Status) == 0) { ?>
			$('#close').click(function(){
				if (confirm('Are you sure you want to close this wish?'))
				{
					window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes/close/" . $wishID; ?>';
				}
			});
		<?php } ?>

		$('td.column-action').find('i.glyphicon-envelope').closest('span').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>messages/add/0/' + $(this).attr('data-userID') + '/' + $(this).attr('data-wishID');
		});

		$('#statusInfo').popover({
			container: 'body',
			html: true,
			placement: 'auto right',
			title: 'Status Info',
			trigger: 'focus',
			content: '<b>Requested:</b> I have requested for help, but the helper has not accepted the request.<br/>' +
					'<b>Offered:</b> The helper has offered to help, but I have not accepted the offer.<br/>' +
					'<b>Accepted:</b> Both the helper and I have agreed on the help.'
		});

	});
</script>