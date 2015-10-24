<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

if (is_numeric($wishID))
{
	$title = "Edit Wish";
	$cancelURL = URL_WITH_INDEX_FILE . "wishes/view/" . $wishID;
}
else
{
	$title = "New Wish";
	$cancelURL = URL_WITH_INDEX_FILE . "wishes";
}
?>

<div class="container">
	<h2 class="page-header"><?php echo $title; ?></h2>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>wishes/save" class="form-horizontal">
		<input type="hidden" id="wishID" name="wishID" value="<?php echo $wishID ?>" />
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<div class="form-group">
			<label for="description" class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				<textarea id="description" name="description" class="form-control" required aria-required="true"><?php echo $wish->Description ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="destinationCity" class="col-sm-2 control-label">Destination City</label>
			<div class="col-sm-10">
				<input type="text" id="destinationCity" name="destinationCity" value="<?php echo $wish->Destination_City ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
			<label for="destinationCountry" class="col-sm-2 control-label">Destination Country</label>
			<div class="col-sm-10">
				<select id="destinationCountry" name="destinationCountry" class="form-control">
					<option value="">&nbsp;</option>
					<?php foreach ($countries as $country) { ?>
						<option value="<?php echo $country->Country_Code; ?>" <?php if (strcasecmp($wish->Destination_Country, $country->Country_Code) == 0) { ?>selected<?php } ?>><?php echo $country->Country_Name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="weight" class="col-sm-2 control-label">Weight</label>
			<div class="col-sm-10">
				<input type="text" id="weight" name="weight" value="<?php echo $wish->Weight ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
			<label for="maxDate" class="col-sm-2 control-label">Max Date</label>
			<div class="col-sm-10">
				<div class="input-group date">
					<input type="text" id="maxDate" name="maxDate" value="<?php echo $wish->Formatted_Max_Date ?>" class="form-control" />
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="compensation" class="col-sm-2 control-label">Compensation</label>
			<div class="col-sm-10">
				<input type="text" id="compensation" name="compensation" value="<?php echo $wish->Compensation ?>" class="form-control" />
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="cancel" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-default">Save</button>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo $cancelURL; ?>';
		});

		$('.input-group.date').datepicker({
			todayBtn: 'linked',
			clearBtn: true
		});

		$('#form').validate({
			rules: {
				maxDate: {
					date: true
				}
			}
		});
	});
</script>