<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2>Profile</h2>
	<div class="section form-horizontal">
		<h3 class="page-header">Login Info</h3>
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $user->Email ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="editLogin" class="btn btn-default">Edit Login Info</button>
			</div>
		</div>
	</div>
	<div class="section form-horizontal">
		<h3 class="page-header">User Details</h3>
		<div class="form-group">
			<label class="col-sm-2 control-label">First Name</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $user->First_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Last Name</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $user->Last_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">City</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $user->City ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">State</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $user->State_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Country</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $user->Country_Name ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Phone</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $user->Phone ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="editProfile" class="btn btn-default">Edit Profile</button>
			</div>
		</div>
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