<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
    <h4>View Wish</h4>
	<div class="section">
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Description</div>
				<div class="view-details-value"><?php echo $wish->Description ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Destination City</div>
				<div class="view-details-value"><?php echo $wish->Destination_City ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Destination Country</div>
				<div class="view-details-value"><?php echo $wish->Destination_Country ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="view-details-label">Weight</div>
				<div class="view-details-value"><?php echo $wish->Weight ?></div>
			</div>
			<div class="col s6">
				<div class="view-details-label">Max Date</div>
				<div class="view-details-value"><?php echo $wish->Max_Date ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Compensation</div>
				<div class="view-details-value"><?php echo $wish->Compensation ?></div>
			</div>
		</div>
		<a id="back" class="btn waves-effect waves-light">Back</a>
		<a id="edit" class="btn waves-effect waves-light">Edit</a>
	</div>
	<div class="section">
		<h5>Helps</h5>
	</div>
	<div class="section">
		<h5>Messages</h5>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#back').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes"; ?>';
		});

		$('#edit').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes/edit/" . $wishID; ?>';
		});
	});
</script>