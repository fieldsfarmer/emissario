<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Profile</h4>
	<div class="section">
		<a id="add" class="btn waves-effect waves-light">Send a Message</a>
		<div class="row">
			<div class="col s12">
				<h5>Email<h5>
				<div class="view-details-value"><?php echo $friend[0]->Email ?></div>
			</div>
		</div>
	</div>
	<div class="section">
		<h5>Friend Details</h5>
		<div class="row">
			<div class="col s6">
				<div class="view-details-label">First Name</div>
				<div class="view-details-value"><?php echo $friend[0]->First_Name ?></div>
			</div>
			<div class="col s6">
				<div class="view-details-label">Last Name</div>
				<div class="view-details-value"><?php echo $friend[0]->Last_Name ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">City</div>
				<div class="view-details-value"><?php echo $friend[0]->City ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="view-details-label">Country</div>
				<div class="view-details-value"><?php echo $friend[0]->Country ?></div>
			</div>
			<div class="col s6">
				<div class="view-details-label">State</div>
				<div class="view-details-value"><?php echo $friend[0]->State ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Phone</div>
				<div class="view-details-value"><?php echo $friend[0]->Phone ?></div>
			</div>
		</div>
		<div class="section">
		<h5>Travel Details</h5>
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
					<?php foreach ($friend as $fri) { ?>
						<tr>
							<td>
									<?php echo $fri->Travel_Date ?>
							</td>
							<td><?php echo $fri->Origin_City ?></td>
							<td><?php echo $fri->Origin_Country ?></td>
							<td><?php echo $fri->Destination_City ?></td>
							<td><?php echo $fri->Destination_Country ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#add').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "messages/edit"; ?>';
		});
	});
</script>