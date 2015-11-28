<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Help Details</h2>
	<div class="section form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $help->Wish_Description; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Destination City</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $help->Wish_Destination_City; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Destination Country</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $help->Wish_Destination_Country_Name; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Owner</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $help->Wish_Owner_First_Name . " " . $help->Wish_Owner_Last_Name; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Help Status</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php if ($help->Requested == 1 && $help->Offered == 1) {
						echo "Accepted";
					}
					else if ($help->Requested == 1) {
						echo "Requested";
					}
					else if ($help->Offered == 1) {
						echo "Offered";
					} ?>
					<a id="helpStatusInfo" tabindex="0" role="button" data-toggle="popover" class="info-button">
						<i class="glyphicon glyphicon-info-sign"></i>
					</a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Weight</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $help->Wish_Weight; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Max Date</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $help->Wish_Max_Date; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Compensation</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $help->Wish_Compensation ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="back" class="btn btn-default">Back</button>
				<button type="button" id="send" class="btn btn-default">Send a Message</button>
			</div>
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

	<?php if ($help->Requested == 1 && $help->Offered == 1) { ?>
		<div class="section form-horizontal">
			<h3 class="page-header">Review From Owner</h3>
			<div class="form-group">
				<label class="col-sm-2 control-label">Recommended</label>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php if ($help->Review_Recommended == 1) {
							echo "Yes";
						}
						elseif ($help->Review_Recommended == 0) {
							echo "No";
						} ?>
					</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Comments</label>
				<div class="col-sm-10">
					<p class="form-control-static"><?php echo $help->Review_Comments; ?></p>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<script>
	$(document).ready(function(){
		$('#back').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>helps';
		});

		$('#send').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/add/0/" . $help->Wish_Owner_ID . "/" . $help->Wish_ID; ?>';
		});

		$('#helpStatusInfo').popover({
			container: 'body',
			html: true,
			placement: 'auto right',
			title: 'Help Status Info',
			trigger: 'focus',
			content: '<b>Offered:</b> I have offered to help, but the owner has not accepted the offer.<br/>' +
					'<b>Requested:</b> The owner has requested for help, but I have not accepted the request.<br/>' +
					'<b>Accepted:</b> Both the owner and I have agreed on the help.'
		});

	});
</script>