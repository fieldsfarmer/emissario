<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">Friends</h2>

	<div class="clearfix table-action">
		<button type="button" id="add" class="btn btn-default pull-left">Add Friends</button>

		<form method="post" class="form-inline table-filter pull-right">
			<div class="form-group">
				<label class="sr-only" for="friendType">Type</label>
				<select id="friendType" name="friendType" class="form-control">
					<option value="friends" <?php if (strcasecmp("friends", $friendType) == 0) { ?>selected<?php } ?>>Friends</option>
					<option value="pending_mine" <?php if (strcasecmp("pending_mine", $friendType) == 0) { ?>selected<?php } ?>>Pending My Approval</option>
					<option value="pending_friend" <?php if (strcasecmp("pending_friend", $friendType) == 0) { ?>selected<?php } ?>>Pending Friends' Approval</option>
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
					<th width="1%">&nbsp;</th>
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
						<td width="1%" class="column-action">
							<?php if (strcasecmp("friends", $friendType) == 0) { ?>
								<span title="Unfriend" data-id="<?php echo $friend->ID; ?>">
									<i class="glyphicon glyphicon-remove"></i>
								</span>
							<?php } elseif (strcasecmp("pending_mine", $friendType) == 0) { ?>
								<span title="Accept" data-id="<?php echo $friend->ID; ?>">
									<i class="glyphicon glyphicon-ok"></i>
								</span>
								<span title="Reject" data-id="<?php echo $friend->ID; ?>">
									<i class="glyphicon glyphicon-remove"></i>
								</span>
							<?php } elseif (strcasecmp("pending_friend", $friendType) == 0) { ?>
								<span title="Cancel" data-id="<?php echo $friend->ID; ?>">
									<i class="glyphicon glyphicon-remove"></i>
								</span>
							<?php } ?>
						</td>
						<td>
							<?php if ($friend->Pending != 1) {?>
								<a href="<?php echo URL_WITH_INDEX_FILE . "friends/view/" . $friend->ID; ?>">
									<?php echo $friend->First_Name ?>
								</a>
							<?php } else {
								echo $friend->First_Name;
							} ?>
						</td>
						<td><?php echo $friend->Last_Name ?></td>
						<td><?php echo $friend->City ?></td>
						<td><?php echo $friend->State ?></td>
						<td><?php echo $friend->Country ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#add').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends/add';
		});

		$('#clear').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends';
		});

		<?php if (strcasecmp("friends", $friendType) == 0) { ?>
			$('td.column-action').find('i.glyphicon-remove').closest('span').click(function(){
				if (confirm('Are you sure you want to unfriend this person?'))
				{
					window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends/delete/' + $(this).attr('data-id') + '/<?php echo $friendType; ?>';
				}
			});
		<?php } elseif (strcasecmp("pending_mine", $friendType) == 0) { ?>
			$('td.column-action').find('i.glyphicon-ok').closest('span').click(function(){
				window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends/accept/' + $(this).attr('data-id');
			});
			$('td.column-action').find('i.glyphicon-remove').closest('span').click(function(){
				window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends/delete/' + $(this).attr('data-id') + '/<?php echo $friendType; ?>';
			});
		<?php } elseif (strcasecmp("pending_friend", $friendType) == 0) { ?>
			$('td.column-action').find('i.glyphicon-remove').closest('span').click(function(){
				window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends/delete/' + $(this).attr('data-id') + '/<?php echo $friendType; ?>';
			});
		<?php } ?>
	});
</script>