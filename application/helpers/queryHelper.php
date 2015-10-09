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
}