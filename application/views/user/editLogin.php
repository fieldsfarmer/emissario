<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

$email = $user->Email;

?>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE . "user"; ?>';
		});

		$('#form').validate({});
	});
</script>

<div class="container">
	<h2 class="page-header">Edit Login Info</h2>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/saveLogin" class="form-horizontal">
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<?php require '_editLogin.php' ?>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="cancel" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-default">Save</button>
			</div>
		</div>
	</form>
</div>