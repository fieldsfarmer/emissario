<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Wishes</h4>
	<a id="add" class="btn waves-effect waves-light">Add a Wish</a>
	<table class="striped">
		<thead>
			<tr>
				<th>Description</th>
				<th>Destination City</th>
				<th>Destination Country</th>
				<th>Weight</th>
				<th>Max Date</th>
				<th>Compensation</th>
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
					<td><?php echo $wish->Destination_Country ?></td>
					<td><?php echo $wish->Weight ?></td>
					<td><?php echo $wish->Max_Date ?></td>
					<td class="truncate"><?php echo $wish->Compensation ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('#add').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "wishes/edit"; ?>';
		});
	});
</script>