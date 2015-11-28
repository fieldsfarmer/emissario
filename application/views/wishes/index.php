<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Wishes</h2>

	<div class="clearfix table-action">
		<button type="button" id="add" class="btn btn-default">Add a Wish</button>
	
		<form method="post" class="form-inline table-filter pull-right">
			<div class="form-group">
				<label class="sr-only" for="wishStatus">Status</label>
				<select id="wishStatus" name="wishStatus" class="form-control">
					<option value="">- Status -</option>
					<option value="not_closed" <?php if (strcasecmp("not_closed", $wishStatus) == 0) { ?>selected<?php } ?>>Not Closed</option>
					<option value="closed" <?php if (strcasecmp("closed", $wishStatus) == 0) { ?>selected<?php } ?>>Closed</option>
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
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($wishes as $wish) { ?>
					<tr>
						<td class="truncate">
							<a href="<?php echo URL_WITH_INDEX_FILE . "wishes/view/" . $wish->ID; ?>">
								<?php echo $wish->Description ?>
							</a>
						</td>
						<td><?php echo $wish->Destination_City ?></td>
						<td><?php echo $wish->Destination_Country_Name ?></td>
						<td><?php echo $wish->Status ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#add').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>wishes/edit';
		});

		$('#clear').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>wishes';
		});
	});
</script>