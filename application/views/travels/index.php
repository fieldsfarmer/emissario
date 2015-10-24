<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Travels</h2>
	<button type="button" id="add" class="btn btn-default">Add a Travel</button>
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
	});
</script>