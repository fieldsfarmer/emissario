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
		<input type="text" id="country" name="country" value="<?php echo $country ?>" placeholder="" />
		<label for="country">Country</label>
	</div>
	<div class="input-field col s6">
		<input type="text" id="state" name="state" value="<?php echo $state ?>" placeholder="" />
		<label for="state">State</label>
	</div>
</div>
<div class="row">
	<div class="input-field col s12">
		<input type="text" id="phone" name="phone" value="<?php echo $phone ?>" placeholder="" />
		<label for="phone">Phone</label>
	</div>
</div>