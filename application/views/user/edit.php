<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

$id = 1;
if (is_numeric($id)) {
	$pageTitle = "Edit Profile";
}
else {
	$pageTitle = "Create an Account";
}
?>

<div class="container">
	<h4><?php echo $pageTitle; ?></h4>
	<form method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/save" class="col s12">
		<input type="hidden" id="userID" name="userID" value="1" />
		<div class="row">
			<div class="input-field col s6">
				<input type="text" id="firstName" name="firstName" value="<?php echo $user->First_Name ?>" class="validate" />
				<label for="firstName">First Name</label>
			</div>
			<div class="input-field col s6">
				<input type="text" id="lastName" name="lastName" value="<?php echo $user->Last_Name ?>" class="validate" />
				<label for="lastName">Last Name</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="email" id="email" name="email" value="<?php echo $user->Email ?>" class="validate" />
				<label for="email">Email</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="password" id="password" name="password" value="" class="validate" />
				<label for="password">Password</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="city" name="city" value="<?php echo $user->City ?>" class="validate" />
				<label for="city">City</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input type="text" id="country" name="country" value="<?php echo $user->Country ?>" class="validate" />
				<label for="country">Country</label>
			</div>
			<div class="input-field col s6">
				<input type="text" id="state" name="state" value="<?php echo $user->State ?>" class="validate" />
				<label for="state">State</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="phone" name="phone" value="<?php echo $user->Phone ?>" class="validate" />
				<label for="phone">Phone</label>
			</div>
		</div>
		<button type="submit" class="btn waves-effect waves-light" name="action">Save</button>
	</form>
</div>