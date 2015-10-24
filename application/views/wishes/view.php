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
				<button type="button" id="edit" class="btn btn-default">Edit</button>
				<button type="button" id="delete" class="btn btn-default">Delete</button>
			</div>
		</div>
	</div>
	<div class="section">
		<h3 class="page-header">Helps</h3>
	</div>
	<div class="section">
		<h3 class="page-header">Messages</h3>
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

		$('#delete').click(function(){
			if (confirm('Are you sure you want to delete this wish?'))
			{
				window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes/delete/" . $wishID; ?>';
			}
		});
	});
</script>