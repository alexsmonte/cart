<?php

/***
* if array_column does not exist the below solution will work.
* http://php.net/manual/pt_BR/function.array-column.php#117229
***/
if(!function_exists("array_column")) {
	function array_column($array,$column_name)
	{
	    return array_map(function($element)use($column_name){ return $element[$column_name]; }, $array);
	}
}


?>