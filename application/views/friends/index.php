<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h4>Friends</h4>
	<table class="striped">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>City</th>
				<th>State</th>
				<th>Country</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($friends as $friend) { ?>
				<tr>
					<td><?php echo $friend->First_Name ?></td>
					<td><?php echo $friend->Last_Name ?></td>
					<td><?php echo $friend->City ?></td>
					<td><?php echo $friend->State ?></td>
					<td><?php echo $friend->Country ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
