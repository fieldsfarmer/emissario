<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
$email = "";
$firstName = "";
$lastName = "";
$city = "";
$country = "";
$state = "";
$phone = "";
?>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>';
		});

		$('#form').validate({});
	});
</script>

<div class="container">
	<h2>Create an Account</h2>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/createAccount" class="form-horizontal">
		<div class="section">
			<h3 class="page-header">Login Info</h3>
			<?php require '_editLogin.php' ?>
		</div>
		<div class="section">
			<h3 class="page-header">User Details</h3>
			<?php require '_editProfile.php' ?>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="cancel" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form>
</div>