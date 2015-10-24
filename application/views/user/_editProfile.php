<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }
?>

<div class="form-group">
	<label for="firstName" class="col-sm-2 control-label">First Name</label>
	<div class="col-sm-10">
		<input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>" class="form-control" required aria-required="true" />
	</div>
</div>
<div class="form-group">
	<label for="lastName" class="col-sm-2 control-label">Last Name</label>
	<div class="col-sm-10">
		<input type="text" id="lastName" name="lastName" value="<?php echo $lastName ?>" class="form-control" required aria-required="true" />
	</div>
</div>
<div class="form-group">
	<label for="city" class="col-sm-2 control-label">City</label>
	<div class="col-sm-10">
		<input type="text" id="city" name="city" value="<?php echo $city ?>" class="form-control" />
	</div>
</div>
<div class="form-group">
	<label for="country" class="col-sm-2 control-label">Country</label>
	<div class="col-sm-10">
		<select id="country" name="country" class="form-control" onchange="refreshStateSelect();">
			<option value="">&nbsp;</option>
			<?php foreach ($countries as $countryOption) { ?>
				<option value="<?php echo $countryOption->Country_Code; ?>" <?php if (strcasecmp($country, $countryOption->Country_Code) == 0) { ?>selected<?php } ?>><?php echo $countryOption->Country_Name; ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="state" class="col-sm-2 control-label">State</label>
	<div class="col-sm-10">
		<select id="state" name="state" class="form-control">
			<option value="">&nbsp;</option>
			<?php if (isset($states)) {
				foreach ($states as $stateOption) { ?>
				<option value="<?php echo $stateOption->State_Code; ?>" <?php if (strcasecmp($state, $stateOption->State_Code) == 0) { ?>selected<?php } ?>><?php echo $stateOption->State_Name; ?></option>
			<?php }} ?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="phone" class="col-sm-2 control-label">Phone</label>
	<div class="col-sm-10">
		<input type="text" id="phone" name="phone" value="<?php echo $phone ?>" class="form-control" />
	</div>
</div>

<script>
	refreshStateSelect = function() {
		$.ajax({
			url: '<?php echo URL_WITH_INDEX_FILE; ?>resources/getStates',
			type: 'post',
			data: {
				country: $('#country').val()
			},
			dataType: 'text',
			success: function(result) {
				$('#state').empty();
				$('#state').append($('<option value="">&nbsp;</option>'));

				if (result.length > 4) {
					result = result.substr(1, result.length - 2);
					states = $.parseJSON(result);

					for (var i = 0; i < states.length; i++) {
						var stateCode = states[i].State_Code;
						var stateName = states[i].State_Name;
						$('#state').append($('<option></option>').attr('value', stateCode).text(stateName));
					}
				}
			},
			error: function() {
				$('#state').empty();
				$('#state').append($('<option value="">&nbsp;</option>'));
			}
		});
	}
</script>