<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Travels</h2>

	<div class="clearfix table-action">
		<button type="button" id="add" class="btn btn-default pull-left">Add a Travel</button>
	
		<form method="post" class="form-inline table-filter pull-right">
			<div class="form-group">
				<label class="sr-only" for="travelDateType">Travel Date</label>
				<select id="travelDateType" name="travelDateType" class="form-control">
					<option value="">- Travel Date -</option>
					<option value="past" <?php if (strcasecmp("past", $travelDateType) == 0) { ?>selected<?php } ?>>Past</option>
					<option value="future" <?php if (strcasecmp("future", $travelDateType) == 0) { ?>selected<?php } ?>>Future</option>
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
						<td>
							<a href="<?php echo URL_WITH_INDEX_FILE . "travels/view/" . $travel->ID; ?>">
								<?php echo $travel->Formatted_Travel_Date ?>
							</a>
						</td>
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
		$('#add').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "travels/edit"; ?>';
		});

		$('#clear').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "travels"; ?>';
		});
	});
</script>