<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

if (strcasecmp("written", $reviewType) == 0)
{
	$viewLink = URL_WITH_INDEX_FILE . "wishes/view/";
}
else
{
	$viewLink = URL_WITH_INDEX_FILE . "helps/view/";
}
?>

<div class="container">
	<h2 class="page-header">Reviews</h2>

	<div class="clearfix table-action">
		<form method="post" class="form-inline table-filter pull-right">
			<div class="form-group">
				<label class="sr-only" for="reviewType">Review Type</label>
				<select id="reviewType" name="reviewType" class="form-control">
					<option value="received" <?php if (strcasecmp("received", $reviewType) == 0) { ?>selected<?php } ?>>Received From Others</option>
					<option value="written" <?php if (strcasecmp("written", $reviewType) == 0) { ?>selected<?php } ?>>Written By Me</option>
				</select>
			</div>
			<div class="form-group">
				<label class="sr-only" for="recommended">Recommended</label>
				<select id="recommended" name="recommended" class="form-control">
					<option value="">- Recommended -</option>
					<option value="1" <?php if ($recommended == 1) { ?>selected<?php } ?>>Yes</option>
					<option value="0" <?php if ($recommended == 0) { ?>selected<?php } ?>>No</option>
				</select>
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
					<th>
						<?php if (strcasecmp("written", $reviewType) == 0) {
							echo "User";
						}
						else {
							echo "Reviewer";
						} ?>
					</th>
					<th>Recommended</th>
					<th>Comments</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($reviews as $review) { ?>
					<tr>
						<td width="1%" class="column-action">
							<?php if (strcasecmp("written", $reviewType) == 0) { ?>
								<span title="View Wish" data-id="<?php echo $review->Wish_ID; ?>">
									<i class="glyphicon glyphicon-th-list"></i>
								</span>
							<?php } else { ?>
								<span title="View Help" data-id="<?php echo $review->Help_ID; ?>">
									<i class="glyphicon glyphicon-th-list"></i>
								</span>
							<?php } ?>
						</td>
						<td>
							<?php if (strcasecmp("written", $reviewType) == 0) {
								echo $review->User_First_Name . " " . $review->User_Last_Name;
							}
							else {
								echo $review->Reviewer_First_Name . " " . $review->Reviewer_Last_Name;
							} ?>
						</td>
						<td>
							<?php if ($review->Recommended == 1) {
								echo "Yes";
							}
							elseif ($review->Recommended == 0) {
								echo "No";
							} ?>
						</td>
						<td><?php echo $review->Comments ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#clear').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>reviews';
		});

		$('td.column-action').find('i.glyphicon-th-list').closest('span').click(function(){
			window.location.href = '<?php echo $viewLink; ?>' + $(this).attr('data-id');
		});
	});
</script>