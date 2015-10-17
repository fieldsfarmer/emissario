<?php

class Resources extends Controller
{

	public function getStates()
	{
		$states = $this->beans->resourceService->getStates($_POST["country"], "State_Code, State_Name");

		var_export(json_encode($states));
	}

}
