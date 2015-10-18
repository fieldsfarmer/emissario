<?php

class Model
{
	/**
	 * @param object $db A PDO database connection
	 */
	function __construct($db)
	{
		$this->db = $db;
	}
}