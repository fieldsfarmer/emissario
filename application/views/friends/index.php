<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Friends</h2>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>City</th>
					<th>State</th>
					<th>Country</th>
					<th>Pending</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($friends as $friend) { ?>
					<tr>
						<td>
							<?php if ($friend->Pending != 1) {?>
							<a href="<?php echo URL_WITH_INDEX_FILE . "friends/view/" . $friend->ID; ?>">
								<?php echo $friend->First_Name ?>
							</a>
							<?php } else { ?>
							<?php echo $friend->First_Name ?>
							<?php } ?>
						</td>
						<td><?php echo $friend->Last_Name ?></td>
						<td><?php echo $friend->City ?></td>
						<td><?php echo $friend->State ?></td>
						<td><?php echo $friend->Country ?></td>
						<td><?php if ($friend->Pending == 1) echo "Yes"; else echo "No"; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
