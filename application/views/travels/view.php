<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Travel Details</h2>
	<div class="section form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">Travel Date</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $travel->Formatted_Travel_Date ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Origin City</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $travel->Origin_City ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Origin Country</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $travel->Origin_Country_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Destination City</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $travel->Destination_City ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Destination Country</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $travel->Destination_Country_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="back" class="btn btn-default">Back</button>
				<button type="button" id="edit" class="btn btn-default">Edit</button>
				<button type="button" id="delete" class="btn btn-default">Delete</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#back').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>travels';
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