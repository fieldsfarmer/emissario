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
	<h4><?php echo $title; ?></h4>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>travels/save" class="col s12" novalidate="novalidate">
		<input type="hidden" id="travelID" name="travelID" value="<?php echo $travelID ?>" />
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="travelDate" name="travelDate" value="<?php echo $travel->Formatted_Travel_Date ?>" class="datepicker validate" required aria-required="true" placeholder="" />
				<label for="travelDate">Travel Date</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="originCity" name="originCity" value="<?php echo $travel->Origin_City ?>" class="validate" required aria-required="true" placeholder="" />
				<label for="originCity">Origin City</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<select id="originCountry" name="originCountry" class="validate" required aria-required="true">
					<option value=""></option>
					<?php foreach ($countries as $country) { ?>
						<option value="<?php echo $country->Country_Code; ?>" <?php if (strcasecmp($travel->Origin_Country, $country->Country_Code) == 0) { ?>selected<?php } ?>><?php echo $country->Country_Name; ?></option>
					<?php } ?>
				</select>
				<label for="originCountry">Origin Country</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="destinationCity" name="destinationCity" value="<?php echo $travel->Destination_City ?>" class="validate" required aria-required="true" placeholder="" />
				<label for="destinationCity">Destination City</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<select id="destinationCountry" name="destinationCountry" class="validate" required aria-required="true">
					<option value=""></option>
					<?php foreach ($countries as $country) { ?>
						<option value="<?php echo $country->Country_Code; ?>" <?php if (strcasecmp($travel->Destination_Country, $country->Country_Code) == 0) { ?>selected<?php } ?>><?php echo $country->Country_Name; ?></option>
					<?php } ?>
				</select>
				<label for="destinationCountry">Destination Country</label>
			</div>
		</div>

		<a id="cancel" class="btn waves-effect waves-light">Cancel</a>
		<button type="submit" class="btn waves-effect waves-light" name="action">Save</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo $cancelURL; ?>';
		});

		$('select').material_select();

		$('.datepicker').pickadate({
			format: 'mm/dd/yyyy'
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