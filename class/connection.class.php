<?php

/**
 * @author mishkaa
 * @copyright 2008
 * @firstdevelopmentdate 15/2
 * @komentar kelas untuk mengkonek ke database 
 */

/*require area*/

/*end of require area*/

class gen_connection{

	function __construct() {
			include_once('config.php');
			$connect = mysql_connect($hostname,$username,$password);
			mysql_select_db($database);
	}
}


?>
