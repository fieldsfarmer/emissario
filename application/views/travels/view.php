<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Travel Details</h4>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Travel Date</div>
			<div class="view-details-value"><?php echo $travel->Formatted_Travel_Date ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Origin City</div>
			<div class="view-details-value"><?php echo $travel->Origin_City ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Origin Country</div>
			<div class="view-details-value"><?php echo $travel->Origin_Country_Name ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Destination City</div>
			<div class="view-details-value"><?php echo $travel->Destination_City ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="view-details-label">Destination Country</div>
			<div class="view-details-value"><?php echo $travel->Destination_Country_Name ?></div>
		</div>
	</div>
	<a id="back" class="btn waves-effect waves-light">Back</a>
	<a id="edit" class="btn waves-effect waves-light">Edit</a>
	<a id="delete" class="btn waves-effect waves-light">Delete</a>
</div>

<script>
	$(document).ready(function(){
		$('#back').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "travels"; ?>';
		});

		$('#edit').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "travels/edit/" . $travelID; ?>';
		});

		$('#delete').click(function(){
			if (confirm('Are you sure you want to delete this travel?'))
			{
				window.location.href = '<?php echo URL_WITH_INDEX_FILE . "travels/delete/" . $travelID; ?>';
			}
		});
	});
</script>