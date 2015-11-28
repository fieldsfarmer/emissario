<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home
{

	public function index()
	{
		if (is_numeric($GLOBALS["beans"]->siteHelper->getSession("userID")))
		{
			header('location: ' . URL_WITH_INDEX_FILE . 'friends');
		}
		else
		{
			require APP . 'views/_templates/header.php';
			require APP . 'views/index.php';
			require APP . 'views/_templates/footer.php';
		}
	}

}
