<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }
?>

<div class="row">
	<div class="input-field col s6">
		<input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>" class="validate" required aria-required="true" placeholder="" />
		<label for="firstName">First Name</label>
	</div>
	<div class="input-field col s6">
		<input type="text" id="lastName" name="lastName" value="<?php echo $lastName ?>" class="validate" required aria-required="true" placeholder="" />
		<label for="lastName">Last Name</label>
	</div>
</div>
<div class="row">
	<div class="input-field col s12">
		<input type="text" id="city" name="city" value="<?php echo $city ?>" placeholder="" />
		<label for="city">City</label>
	</div>
</div>
<div class="row">
	<div class="input-field col s6">
		<select id="country" name="country" onchange="refreshStateSelect();">
			<option value=""></option>
			<?php foreach ($countries as $countryOption) { ?>
				<option value="<?php echo $countryOption->Country_Code; ?>" <?php if (strcasecmp($country, $countryOption->Country_Code) == 0) { ?>selected<?php } ?>><?php echo $countryOption->Country_Name; ?></option>
			<?php } ?>
		</select>
		<label for="country">Country</label>
	</div>
	<div class="input-field col s6">
		<select id="state" name="state">
			<option value=""></option>
			<?php if (isset($states)) {
				foreach ($states as $stateOption) { ?>
				<option value="<?php echo $stateOption->State_Code; ?>" <?php if (strcasecmp($state, $stateOption->State_Code) == 0) { ?>selected<?php } ?>><?php echo $stateOption->State_Name; ?></option>
			<?php }} ?>
		</select>
		<label for="state">State</label>
	</div>
</div>
<div class="row">
	<div class="input-field col s12">
		<input type="text" id="phone" name="phone" value="<?php echo $phone ?>" placeholder="" />
		<label for="phone">Phone</label>
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
				$('#state').append($('<option value=""></option>'));

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
				$('#state').append($('<option value=""></option>'));
			},
			complete: function() {
				$('#state').material_select();
			}
		});
	}
</script>