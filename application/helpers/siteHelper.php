<?php

class SiteHelper
{
	public function getNavigationHTML($views, $activeView)
	{
		$html = "";

		foreach ($views as $view => $viewTitle)
		{
			$html .= '<li ';
			if (strcasecmp($activeView,$view) == 0)
			{
				$html .= 'class="active"';
			}
			$html .= '>
					<a href="' . URL_WITH_INDEX_FILE . $view . '">' . $viewTitle . '</a>
				</li>';
		}

		$html .= '<li>
				<a href="' . URL_WITH_INDEX_FILE . 'user/logout">Logout</a>
			</li>';
		
		return $html;
	}
	
	public function getSession($variableName)
	{
		$value = "";

		if (!isset($_SESSION))
		{
			session_start();
		}
		
		if (array_key_exists($variableName, $_SESSION))
		{
			$value = $_SESSION[$variableName];
		}
		
		return $value;
	}

	public function setSession($variableName, $value)
	{
		if (!isset($_SESSION))
		{
			session_start();
		}

		$_SESSION[$variableName] = $value;
	}
}