<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
$email = "";
$firstName = "";
$lastName = "";
$city = "";
$country = "";
$state = "";
$phone = "";
?>

<div class="container">
	<h4>Create an Account</h4>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/createAccount" class="col s12" novalidate="novalidate">
		<div class="section">
			<h5>Login Info</h5>
			<?php require '_editLogin.php' ?>
		</div>
		<div class="section">
			<h5>Profile</h5>
			<?php require '_editProfile.php' ?>
		</div>
		<a id="cancel" class="btn waves-effect waves-light" style="margin-right:10px;">Cancel</a>
		<button type="submit" class="btn waves-effect waves-light" name="action">Submit</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>';
		});
	});
</script>