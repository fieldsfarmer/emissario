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

<div class="form-group">
	<label for="email" class="col-sm-2 control-label">Email</label>
	<div class="col-sm-10">
		<input type="hidden" id="existingEmail" name="existingEmail" value="<?php echo $email ?>" />
		<input type="email" id="email" name="email" value="<?php echo $email ?>" class="form-control" required aria-required="true" />
	</div>
</div>
<div class="form-group">
	<label for="password" class="col-sm-2 control-label"><?php echo $passwordLabel; ?></label>
	<div class="col-sm-10">
		<input type="password" id="password" name="password" class="form-control" <?php if ($newUser) { ?>required aria-required="true"<?php } ?> />
	</div>
</div>
<div class="form-group">
	<label for="confirmPassword" class="col-sm-2 control-label">Confirm <?php echo $passwordLabel; ?></label>
	<div class="col-sm-10">
		<input type="password" id="confirmPassword" name="confirmPassword" class="form-control" <?php if ($newUser) { ?>required aria-required="true"<?php } ?> />
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#email').rules('add', {
			email: true,
			remote: {
				depends: function(element) {
					return $('#existingEmail').val() != $(element).val();
				},
				param: {
					url: '<?php echo URL_WITH_INDEX_FILE; ?>user/checkUniqueEmail',
					type: 'post'
				}
			},
			messages: {
				remote: 'There is an existing account with this email.'
			}
		});

		$('#confirmPassword').rules('add', {
			equalTo: '#password',
			messages: {
				equalTo: 'Confirm password should match password.'
			}
		});
	});
</script>