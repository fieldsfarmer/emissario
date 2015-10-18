<?php

// This here blocks direct access to this file (so an attacker can't look into application/views/_templates/header.php).
// "$this" only exists if header.php is loaded from within the app, but not if THIS file here is called directly.
// If someone called header.php directly we completely stop everything via exit() and send a 403 server status code.
// Also make sure there are NO spaces etc. before "<!DOCTYPE" as this might break page rendering.
if (!$this) {
	exit(header('HTTP/1.0 403 Forbidden'));
}

$views = array(
		"friends" => "Friends",
		"travels" => "Travels",
		"wishes" => "Wishes",
		"messages" => "Messages",
		"helps" => "Help Others"
	);

$activeView = "";
if (array_key_exists("PATH_INFO", $_SERVER)) {
	$pathInfoArray = explode("/", $_SERVER["PATH_INFO"]);
	$activeView = $pathInfoArray[1];
}

$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Emissario</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- JS -->
	<!-- jQuery, loaded in the recommended protocol-less way -->
	<!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="<?php echo URL; ?>public/js/jquery.validate.js" type="text/javascript"></script>
	<script>
		$.validator.setDefaults({
			errorClass: 'invalid',
			validClass: 'valid',
			errorPlacement: function (error, element) {
				if ($(element).parent().hasClass('select-wrapper')) {
					error.insertAfter($(element).parent().siblings('label'));
				}
				else {
					error.insertAfter($(element).siblings('label'));
				}
			},
			onfocusout: function (element) {
				$(element).valid();
			}
		});
	</script>

	<!-- CSS -->
	<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="<?php echo URL; ?>public/css/materialize.css" rel="stylesheet" type="text/css" media="screen,projection" />
</head>
<body class="grey lighten-5 grey-text text-darken-2">
	<div class="top-bar hide-on-small-only">
		<div class="nav-wrapper">
			<ul id="nav-top-bar" class="right">
				<li>
					<a class="dropdown-button" href="#!" data-beloworigin="true" data-activates="top-bar-dropdown">
						User Name
						<i class="material-icons right">arrow_drop_down</i>
					</a>
				</li>
			</ul>
		</div>
		<ul id="top-bar-dropdown" class="dropdown-content">
			<li>
				<a href="<?php echo URL_WITH_INDEX_FILE; ?>user">Profile</a>
			</li>
			<li>
				<a href="<?php echo URL_WITH_INDEX_FILE; ?>user/logout">Logout</a>
			</li>
		</ul>
	</div>

	<!-- header -->
	<div class="container">
		<!-- navigation -->
		<nav>
			<div class="nav-wrapper">
				<?php if (is_numeric($userID)) { ?>
					<a href="#" data-activates="nav-mobile" class="button-collapse hide-on-med-and-up"><i class="material-icons">menu</i></a>
				<?php } ?>
				<a href="<?php echo URL_WITH_INDEX_FILE; ?>" class="brand-logo left">Emissario</a>
				<?php if (is_numeric($userID)) { ?>
					<ul id="nav-normal" class="left hide-on-small-only">
						<?php echo $GLOBALS["beans"]->siteHelper->getNavigationHTML($views, $activeView); ?>
					</ul>
					<ul id="nav-mobile" class="side-nav">
						<li>
							<a href="<?php echo URL_WITH_INDEX_FILE; ?>user">Profile</a>
						</li>
						<?php echo $GLOBALS["beans"]->siteHelper->getNavigationHTML($views, $activeView); ?>
						<li>
							<a href="<?php echo URL_WITH_INDEX_FILE; ?>user/logout">Logout</a>
						</li>
					</ul>
				<?php } ?>
			</div>
		</nav>
	</div>
