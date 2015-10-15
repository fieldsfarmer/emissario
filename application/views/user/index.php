<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
    <h4>Profile</h4>
	<div class="section">
		<h5>Login Info</h5>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Email</div>
				<div class="view-details-value"><?php echo $user->Email ?></div>
			</div>
		</div>
		<a id="editLogin" class="btn waves-effect waves-light">Edit Login Info</a>
	</div>
	<div class="section">
		<h5>Profile</h5>
		<div class="row">
			<div class="col s6">
				<div class="view-details-label">First Name</div>
				<div class="view-details-value"><?php echo $user->First_Name ?></div>
			</div>
			<div class="col s6">
				<div class="view-details-label">Last Name</div>
				<div class="view-details-value"><?php echo $user->Last_Name ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">City</div>
				<div class="view-details-value"><?php echo $user->City ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="view-details-label">Country</div>
				<div class="view-details-value"><?php echo $user->Country ?></div>
			</div>
			<div class="col s6">
				<div class="view-details-label">State</div>
				<div class="view-details-value"><?php echo $user->State ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="view-details-label">Phone</div>
				<div class="view-details-value"><?php echo $user->Phone ?></div>
			</div>
		</div>
		<a id="editProfile" class="btn waves-effect waves-light">Edit Profile</a>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#editLogin').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "user/editLogin"; ?>';
		});

		$('#editProfile').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "user/editProfile"; ?>';
		});
	});
</script>