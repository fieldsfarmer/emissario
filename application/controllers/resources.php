<?php

class Resources
{

	public function getStates()
	{
		$states = $GLOBALS["beans"]->resourceService->getStates($_POST["country"], "State_Code, State_Name");

		echo json_encode($states);
	}

}
