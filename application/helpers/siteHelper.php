<?php

class SiteHelper
{
	public function getNavigationHTML($views, $activeView) {
		$html = "";

		foreach ($views as $view => $viewTitle) {
			$html .= '<li ';
			if (strcasecmp($activeView,$view) == 0) {
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
}