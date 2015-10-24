<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

if (is_numeric($travelID))
{
	$title = "Edit Travel";
	$cancelURL = URL_WITH_INDEX_FILE . "travels/view/" . $travelID;
}
else
{
	$title = "New Travel";
	$cancelURL = URL_WITH_INDEX_FILE . "travels";
}
?>

<div class="container">
	<h2 class="page-header"><?php echo $title; ?></h2>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>travels/save" class="form-horizontal">
		<input type="hidden" id="travelID" name="travelID" value="<?php echo $travelID ?>" />
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<div class="form-group">
			<label for="travelDate" class="col-sm-2 control-label">Travel Date</label>
			<div class="col-sm-10">
				<div class="input-group date">
					<input type="text" id="travelDate" name="travelDate" value="<?php echo $travel->Formatted_Travel_Date ?>" class="form-control" required aria-required="true" />
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="originCity" class="col-sm-2 control-label">Origin City</label>
			<div class="col-sm-10">
				<input type="text" id="originCity" name="originCity" value="<?php echo $travel->Origin_City ?>" class="form-control" required aria-required="true" />
			</div>
		</div>
		<div class="form-group">
			<label for="originCountry" class="col-sm-2 control-label">Origin Country</label>
			<div class="col-sm-10">
				<select id="originCountry" name="originCountry" class="form-control" required aria-required="true">
					<option value="">&nbsp;</option>
					<?php foreach ($countries as $country) { ?>
						<option value="<?php echo $country->Country_Code; ?>" <?php if (strcasecmp($travel->Origin_Country, $country->Country_Code) == 0) { ?>selected<?php } ?>><?php echo $country->Country_Name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="destinationCity" class="col-sm-2 control-label">Destination City</label>
			<div class="col-sm-10">
				<input type="text" id="destinationCity" name="destinationCity" value="<?php echo $travel->Destination_City ?>" class="form-control" required aria-required="true" />
			</div>
		</div>
		<div class="form-group">
			<label for="destinationCountry" class="col-sm-2 control-label">Destination Country</label>
			<div class="col-sm-10">
				<select id="destinationCountry" name="destinationCountry" class="form-control" required aria-required="true">
					<option value="">&nbsp;</option>
					<?php foreach ($countries as $country) { ?>
						<option value="<?php echo $country->Country_Code; ?>" <?php if (strcasecmp($travel->Destination_Country, $country->Country_Code) == 0) { ?>selected<?php } ?>><?php echo $country->Country_Name; ?></option>
					<?php } ?>
				</select>
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
				travelDate: {
					date: true
				}
			}
		});
	});
</script>