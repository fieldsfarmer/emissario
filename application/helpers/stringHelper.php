<?php

class StringHelper
{

	public function left($string, $length)
	{
		$result = trim($string);
		if (strlen($result) > $length)
		{
			$result = substr($result, 0, $length);
		}

		return $result;
	}

	public function right($string, $length)
	{
		$result = trim($string);
		if (strlen($result) > $length)
		{
			$result = substr($result, strlen($result) - $length, $length);
		}

		return $result;
	}

}