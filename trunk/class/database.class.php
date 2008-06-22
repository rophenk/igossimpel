<?php

/**
 * @author mishkaa
 * @copyright 2008
 * @firstdevelopmentdate 15/2
 * @komentar kelas dasar fungsi-fungsi database
 */

/*require area*/
require_once('connection.class.php');
$conn = new gen_connection;
/*end of require area*/

class database  {
        
    	public function getData($query) {
    	    
		$data = false;
		
			$result = @mysql_query($query);
			
			if($result){
                		
				for($a=0; $row = mysql_fetch_array($result,MYSQL_ASSOC); $a++)
				{				
					$data[$a] = $row;
				}
			}

			return $data;
		}		
		
		function getDataind($query) {
			
			$data = false;
			$result = @mysql_query($query);
			
			if($result){
				for($a=0; $row = mysql_fetch_array($result); $a++)
				{				
					$data[$a] = $row;
				}
			
				
			}
			
			return $data;
			
		}
		
		function getOneData($query) {
		$data = false;
			$result = @mysql_query($query);
			if($result)	$data = mysql_fetch_array($result);		
			return $data;
		}
	
		function getItem($query) {
			$data = false;
			$result = @mysql_query($query);
			if($result) $data = mysql_fetch_array($result);		
			return $data[0];
		}
	
		function changeData($query) {
			$data = false;
			$ubah = @mysql_query($query);				
			if ($ubah) $data = @mysql_insert_id();
			return $data;
		}
		
		function countData($query) {
			//echo $query;
			$result = @mysql_query($query);				
			$datacount = mysql_num_rows($result);				
			return $datacount;
		}
}
?>