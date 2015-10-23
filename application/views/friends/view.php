<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Friend Details</h4>
	<div class="section">
		<div class="row">
			<div class="col s6">
				<div class="view-details-label">First Name</div>
				<div class="view-details-value"><?php echo $friend->First_Name ?></div>
			</div>
			<div class="col s6">
				<div class="view-details-label">Last Name</div>
				<div class="view-details-value"><?php echo $friend->Last_Name ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="view-details-label">City</div>
				<div class="view-details-value"><?php echo $friend->City ?></div>
			</div>
			<div class="col s6">
				<div class="view-details-label">State</div>
				<div class="view-details-value"><?php echo $friend->State ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Country</div>
				<div class="view-details-value"><?php echo $friend->Country ?></div>
			</div>
		</div>
		<a id="back" class="btn waves-effect waves-light">Back</a>
		<a id="send" class="btn waves-effect waves-light">Send a Message</a>
		<a id="unfriend" class="btn waves-effect waves-light">Unfriend</a>
	</div>
	<div class="section">
		<h5>Future Travels</h5>
		<table class="striped">
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

<script>
	$(document).ready(function(){
		$('#back').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "friends"; ?>';
		});

		$('#send').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/add/0/" . $friendID; ?>';
		});

		$('#unfriend').click(function(){
			if (confirm('Are you sure you want to unfriend this person?'))
			{
				window.location.href = '<?php echo URL_WITH_INDEX_FILE . "friends/unfriend/" . $friendID; ?>';
			}
		});
	});
</script>
