<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Help Others</h2>

	<div class="clearfix table-action">
		<form method="post" class="form-inline table-filter pull-right">
			<div class="form-group">
				<label class="sr-only" for="wishStatus">Wish Status</label>
				<select id="wishStatus" name="wishStatus" class="form-control">
					<option value="">- Wish Status -</option>
					<option value="not_closed" <?php if (strcasecmp("not_closed", $wishStatus) == 0) { ?>selected<?php } ?>>Not Closed</option>
					<option value="closed" <?php if (strcasecmp("closed", $wishStatus) == 0) { ?>selected<?php } ?>>Closed</option>
				</select>
			</div>
			<div class="form-group">
				<label class="sr-only" for="helpStatus">Help Status</label>
				<select id="helpStatus" name="helpStatus" class="form-control">
					<option value="">- Help Status -</option>
					<option value="offered" <?php if (strcasecmp("offered", $helpStatus) == 0) { ?>selected<?php } ?>>Offered</option>
					<option value="requested" <?php if (strcasecmp("requested", $helpStatus) == 0) { ?>selected<?php } ?>>Requested</option>
					<option value="accepted" <?php if (strcasecmp("accepted", $helpStatus) == 0) { ?>selected<?php } ?>>Accepted</option>
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
					<th>Description</th>
					<th>Destination City</th>
					<th>Destination Country</th>
					<th>Owner</th>
					<th>Wish Status</th>
					<th>
						Help Status
						<a id="helpStatusInfo" tabindex="0" role="button" data-toggle="popover" class="info-button">
							<i class="glyphicon glyphicon-info-sign"></i>
						</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($helps as $help) { ?>
					<tr>
						<td class="truncate">
							<a href="<?php echo URL_WITH_INDEX_FILE . "helps/view/" . $help->ID; ?>">
								<?php echo $help->Wish_Description ?>
							</a>
						</td>
						<td><?php echo $help->Wish_Destination_City; ?></td>
						<td><?php echo $help->Wish_Destination_Country_Name; ?></td>
						<td><?php echo $help->Wish_Owner_First_Name . " " . $help->Wish_Owner_Last_Name; ?></td>
						<td><?php echo $help->Wish_Status; ?></td>
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

<script>
	$(document).ready(function(){
		$('#clear').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>helps';
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