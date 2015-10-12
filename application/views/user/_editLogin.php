<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

if (isset($userID) && is_numeric($userID))
{
	$newUser = false;
	$passwordLabel = "New Password";
}
else
{
	$newUser = true;
	$passwordLabel = "Password";
}
?>

<div class="row">
	<div class="input-field col s12">
		<input type="hidden" id="existingEmail" name="existingEmail" value="<?php echo $email ?>" />
		<input type="email" id="email" name="email" value="<?php echo $email ?>" class="validate" required aria-required="true" placeholder="" />
		<label for="email">Email</label>
	</div>
</div>
<div class="row">
	<div class="input-field col s12">
		<input type="password" id="password" name="password" value="" class="validate" <?php if ($newUser) { ?>required aria-required="true"<?php } ?> placeholder="" />
		<label for="password"><?php echo $passwordLabel; ?></label>
	</div>
</div>
<div class="row">
	<div class="input-field col s12">
		<input type="password" id="confirmPassword" name="confirmPassword" value="" class="validate" <?php if ($newUser) { ?>required aria-required="true"<?php } ?> placeholder="" />
		<label for="confirmPassword">Confirm <?php echo $passwordLabel; ?></label>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#form').validate({
			rules: {
				email: {
					email: true,
					remote: {
						depends: function(element) {
							return $('#existingEmail').val() != $(element).val();
						},
						param: {
							url: '<?php echo URL_WITH_INDEX_FILE; ?>user/checkUniqueEmail',
							type: 'post'
						}
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