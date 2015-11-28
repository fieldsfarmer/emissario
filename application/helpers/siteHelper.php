<?php

class SiteHelper
{
	public function getNavigationHTML($activeView)
	{
		$html = "";

		$views = array(
				"friends" => "Friends",
				"travels" => "Travels",
				"wishes" => "Wishes",
				"messages" => "Messages",
				"helps" => "Help Others",
				"reviews" => "Reviews"
			);

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
		
		return $html;
	}
	
	public function getSession($variableName)
	{
		$value = "";

		if (array_key_exists($variableName, $_SESSION))
		{
			$value = $_SESSION[$variableName];
		}
		
		return $value;
	}

	/* Options for $type:
	 *		success (light green background)
	 *		info (light blue background)
	 *		warning (light yellow background)
	 *		danger (pink background)
	 */
	public function setAlert($type, $message)
	{
		$_SESSION["alert"] = new stdClass();
		$_SESSION["alert"]->type = $type;
		$_SESSION["alert"]->message = $message;
	}
	
	public function getAlertHTML()
	{
		$html = "";
		$alert = $this->getSession("alert");
	
		if (is_object($alert))
		{
			$html = "<div class='alert alert-" . $alert->type . "' role='alert'>" . $alert->message . "</div>";
		}
	
		$_SESSION["alert"] = "";
	
		return $html;
	}

}