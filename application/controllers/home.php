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
		require APP . 'views/_templates/header.php';
		if (is_numeric($GLOBALS["beans"]->siteHelper->getSession("userID")))
		{
		require APP . 'views/home/index.php';
		}
		else
		{
			require APP . 'views/index.php';
		}
		require APP . 'views/_templates/footer.php';
	}

}
