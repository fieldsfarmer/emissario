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
	<h4>Edit Login Info</h4>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/saveLogin" class="col s12" novalidate="novalidate">
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />
		<?php require '_editLogin.php' ?>
		<a id="cancel" class="btn waves-effect waves-light">Cancel</a>
		<button type="submit" class="btn waves-effect waves-light" name="action">Save</button>
	</form>
</div>