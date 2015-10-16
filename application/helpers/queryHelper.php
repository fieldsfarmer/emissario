<?php

class QueryHelper
{
	public function getSingleRowObject($query) {
		$result = $query->fetch();

		if (!$result) {
			$result = new stdClass();
			for ($i = 0; $i < $query->columnCount(); $i++) {
				$columnMeta = $query->getColumnMeta($i);
				$result->{$columnMeta["name"]} = "";
			}
		}
		
		return $result;
	}
	
	public function executeWriteQuery($db, $sql, $parameters) {
		foreach ($parameters as $parameterKey => $parameterValue)
		{
			if (empty($parameterValue))
			{
				$parameters[$parameterKey] = null;
			}
		}

		$query = $db->prepare($sql);
		$query->execute($parameters);
		
		if (substr(ltrim($sql), 0, 6) == "INSERT") {
			return $db->lastInsertId();
		}
	}
}