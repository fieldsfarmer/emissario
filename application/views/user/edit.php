<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
if (is_numeric($userID)) {
	$pageTitle = "Edit Profile";
	$buttonText = "Save";
	$cancelURL = URL_WITH_INDEX_FILE . "user/index";
}
else {
	$pageTitle = "Create an Account";
	$buttonText = "Submit";
	$cancelURL = URL_WITH_INDEX_FILE;
}
?>

<div class="container">
	<h4><?php echo $pageTitle; ?></h4>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/save" class="col s12" novalidate="novalidate">
		<input type="hidden" id="userID" name="userID" value="$userID" />
		<div class="section">
			<h5>Login Info</h5>
			<div class="row">
				<div class="input-field col s12">
					<input type="email" id="email" name="email" value="<?php echo $user->Email ?>" class="validate" required aria-required="true" placeholder="" />
					<label for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="password" id="password" name="password" value="" class="validate" required aria-required="true" placeholder="" />
					<label for="password">Password</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="password" id="confirmPassword" name="confirmPassword" value="" class="validate" placeholder="" />
					<label for="confirmPassword">Confirm Password</label>
				</div>
			</div>
		</div>
		<div class="section">
			<h5>Profile</h5>
			<div class="row">
				<div class="input-field col s6">
					<input type="text" id="firstName" name="firstName" value="<?php echo $user->First_Name ?>" class="validate" required aria-required="true" placeholder="" />
					<label for="firstName">First Name</label>
				</div>
				<div class="input-field col s6">
					<input type="text" id="lastName" name="lastName" value="<?php echo $user->Last_Name ?>" class="validate" required aria-required="true" placeholder="" />
					<label for="lastName">Last Name</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" id="city" name="city" value="<?php echo $user->City ?>" placeholder="" />
					<label for="city">City</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input type="text" id="country" name="country" value="<?php echo $user->Country ?>" placeholder="" />
					<label for="country">Country</label>
				</div>
				<div class="input-field col s6">
					<input type="text" id="state" name="state" value="<?php echo $user->State ?>" placeholder="" />
					<label for="state">State</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" id="phone" name="phone" value="<?php echo $user->Phone ?>" placeholder="" />
					<label for="phone">Phone</label>
				</div>
			</div>
		</div>
		<a id="cancel" class="btn waves-effect waves-light" style="margin-right:10px;">Cancel</a>
		<button type="submit" class="btn waves-effect waves-light" name="action"><?php echo $buttonText ?></button>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo $cancelURL; ?>';
		});
	
		$('#form').validate({
			rules: {
				email: {
					email: true,
					remote: {
						url: '<?php echo URL_WITH_INDEX_FILE; ?>user/checkUniqueEmail',
						type: 'post'
					}
				},
				confirmPassword: {
					equalTo: '#password'
				}
			},
			messages: {
				email: {
					remote: 'There is an existing account with this email.'
				},
				confirmPassword: {
					equalTo: 'Confirm password should match password.'
				}
			}
		});
	});
</script>