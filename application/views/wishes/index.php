<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Wishes</h2>
	<button type="button" id="add" class="btn btn-default">Add a Wish</button>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Description</th>
					<th>Destination City</th>
					<th>Destination Country</th>
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
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#add').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes/edit"; ?>';
		});
	});
</script>