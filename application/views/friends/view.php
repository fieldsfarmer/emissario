<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Friend Details</h2>
	<div class="section form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">First Name</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $friend->First_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Last Name</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $friend->Last_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">City</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $friend->City ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">State</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $friend->State ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Country</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $friend->Country ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="back" class="btn btn-default">Back</button>
				<button type="button" id="send" class="btn btn-default">Send a Message</button>
				<button type="button" id="unfriend" class="btn btn-default">Unfriend</button>
			</div>
		</div>
	</div>
	<div class="section">
		<h3 class="page-header">Future Travels</h3>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Travel Date</th>
						<th>Origin City</th>
						<th>Origin Country</th>
						<th>Destination City</th>
						<th>Destination Country</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($travels as $travel) { ?>
						<tr>
							<td><?php echo $travel->Formatted_Travel_Date ?></td>
							<td><?php echo $travel->Origin_City ?></td>
							<td><?php echo $travel->Origin_Country_Name ?></td>
							<td><?php echo $travel->Destination_City ?></td>
							<td><?php echo $travel->Destination_Country_Name ?></td>
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
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends';
		});

		$('#send').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/add/0/" . $friendID; ?>';
		});

		$('#unfriend').click(function(){
			if (confirm('Are you sure you want to unfriend this person?'))
			{
				window.location.href = '<?php echo URL_WITH_INDEX_FILE . "friends/delete/" . $friendID; ?>/';
			}
		});
	});
</script>
