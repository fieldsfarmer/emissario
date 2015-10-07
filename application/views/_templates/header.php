<?php

// This here blocks direct access to this file (so an attacker can't look into application/views/_templates/header.php).
// "$this" only exists if header.php is loaded from within the app, but not if THIS file here is called directly.
// If someone called header.php directly we completely stop everything via exit() and send a 403 server status code.
// Also make sure there are NO spaces etc. before "<!DOCTYPE" as this might break page rendering.
if (!$this) {
    exit(header('HTTP/1.0 403 Forbidden'));
}

$views = "friends,travels,wishes,messages,helps";

$pathInfoArray = explode("/", $_SERVER["PATH_INFO"]);
$activeView = $pathInfoArray[1];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Emissario</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
	<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="<?php echo URL; ?>public/css/materialize.css" rel="stylesheet" type="text/css" media="screen,projection" />
</head>
<body class="grey lighten-5 grey-text text-darken-2">
    <!-- header -->
    <div class="container">
        <!-- navigation -->
		<nav>
			<div class="nav-wrapper">
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
				<a href="<?php echo URL_WITH_INDEX_FILE; ?>" class="brand-logo left">Emissario</a>
				<ul id="nav-normal" class="left hide-on-med-and-down">
					<?php foreach (explode(",", $views) as $view) { ?>
						<li <?php if (strcasecmp($activeView,$view) == 0): ?>class="active"<?php endif ?>>
							<a href="<?php echo URL_WITH_INDEX_FILE . $view; ?>"><?php echo strtoupper($view) ?></a>
						</li>
					<?php } ?>
				</ul>
				<ul id="nav-mobile" class="side-nav">
					<?php foreach (explode(",", $views) as $view) { ?>
						<li <?php if (strcasecmp($activeView,$view) == 0): ?>class="active"<?php endif ?>>
							<a href="<?php echo URL_WITH_INDEX_FILE . $view; ?>"><?php echo strtoupper($view) ?></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</nav>
    </div>
