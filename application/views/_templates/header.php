<?php

// This here blocks direct access to this file (so an attacker can't look into application/views/_templates/header.php).
// "$this" only exists if header.php is loaded from within the app, but not if THIS file here is called directly.
// If someone called header.php directly we completely stop everything via exit() and send a 403 server status code.
// Also make sure there are NO spaces etc. before "<!DOCTYPE" as this might break page rendering.
if (!$this) {
	exit(header('HTTP/1.0 403 Forbidden'));
}

$activeView = "";
if (array_key_exists("PATH_INFO", $_SERVER)) {
	$pathInfoArray = explode("/", $_SERVER["PATH_INFO"]);
	$activeView = $pathInfoArray[1];
}

if (!isset($userID)) {
	$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
}
if (!isset($user)) {
	$user = $GLOBALS["beans"]->userService->getUser($userID);
}

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Emissario</title>
	<meta name="description" content="">

	<!-- CSS -->
	<link href="<?php echo URL; ?>public/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo URL; ?>public/css/bootstrap-theme.css" rel="stylesheet">
	<link href="<?php echo URL; ?>public/css/bootstrap-datepicker3.css" rel="stylesheet">

	<!-- JS -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="<?php echo URL; ?>public/js/jquery.validate.js" type="text/javascript"></script>
	<script src="<?php echo URL; ?>public/js/bootstrap.js"></script>
	<script src="<?php echo URL; ?>public/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo URL; ?>public/js/application.js"></script>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script>
		$.validator.setDefaults({
			errorElement: 'span',
			errorClass: 'help-block error-help-block',
			errorPlacement: function (error, element) {
				if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
					error.insertAfter(element.parent());
				}
				else {
					error.insertAfter(element);
				}
			},
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			onfocusout: function (element) {
				$(element).valid();
			}
		});

		$(document).ready(function(){
			// Add asterisk to required fields
			$('input,textarea,select').filter('[required]').each(function(index, element) {
				$(element).closest('.form-group').find('label').append('<span class="asterisk-required">*</span>');
			});
		});
	</script>
</head>
<body>
	<!-- top bar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<?php if (is_numeric($userID)) { ?>
					<button class="navbar-toggle collapsed" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" type="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				<?php } ?>
				<a class="navbar-brand" href="<?php echo URL_WITH_INDEX_FILE; ?>">Emissario</a>
			</div>
			<?php if (is_numeric($userID)) { ?>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-left">
						<?php echo $GLOBALS["beans"]->siteHelper->getNavigationHTML($activeView); ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" href="#!" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
								<?php echo $user->First_Name . " " . $user->Last_Name ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo URL_WITH_INDEX_FILE; ?>user">Profile</a>
								</li>
								<li>
									<a href="<?php echo URL_WITH_INDEX_FILE; ?>user/logout">Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			<?php } ?>
		</div>
	</nav>
