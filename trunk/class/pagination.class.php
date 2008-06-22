<?php

/**
 * @author 
 * @copyright 2008
 */

class pagination {
	/*ADD BY RIKI 19 Juni 2008 */
	 /**
	   * paging::__construct()
	   * constructor class
	   * definisi settingan dasar class
	   * @param mixed $table       // table yang digunakan untuk data  e.g. news, seputar, faq 						   			 
	   * @param mixed $globalurl   // public url untuk module yg memakai kelas tsb  e.g. ?mod=rumah&opt=faq
	   * @return void
   */
	public function construct($table,$globalurl){
	    
		$this->pagelink = $globalurl;
		$this->table = $table;
	}
	/*ADD BY RIKI 19 Juni 2008 */
 /**
   * journal::setPagination()
   *
   * @param mixed $tipe        //  tipe paginationnya     								 
   *                         values.blogdesc  -- buat individual post
   *                               .paging    -- paging index halaman
   *                               .blogindex -- show semua jenis paging 
   * @param mixed $totaldata   //  total data dari query
   * @param string $table      //  table datanya   --  hanya untuk pemanggilan tipe individual
   * @param string $id         //  table id -- id data yang sekarang
   * @return void
   */
	public function setPagination($tipe,$totaldata=1){

		global $database;

		$page = $_GET['hal'];
		$index = $page+1;

		$pglim = $this->pagelimit;	
		
		$table = $this->table;
		$id = $_GET['item'];
				
		$totalpage  = ceil($totaldata/$this->datalimit);
		$lastdata = $totalpage  % $pglim;	
		if($lastdata==0&&$totalpage>1) $lastdata = $pglim;
	    $totalpaging = ceil($totalpage/$pglim);
		$indexpaging = ceil($index/$pglim);		

		if($_GET['mod']=="listing") $link = $this->pagelink."&do=result";
		else $link = $this->pagelink;

		if($tipe=="blogdesc") {					
			$prev = database::getData("SELECT max(".$table."_id) from ".$table." where ".$table."_id < ".$id." ");
			if(!empty($prev[0]["max(".$table."_id)"])) $nav_prev = "<a href=".$link."&item=".$prev[0]["max(".$table."_id)"].">prev</a>"; 		
			
			$next = database::getData("SELECT min(".$table."_id) from ".$table." where ".$table."_id > ".$id." ");
			if(!empty($next[0]["min(".$table."_id)"])) $nav_next = "<a href=".$link."&item=".$next[0]["min(".$table."_id)"].">next</a>";
		}
		else{			
			// navigate 1 page at a time
			$prev = $page-1;
			if($prev>=0)	$nav_prev = "<a href=".$link."&page=".$prev.">prev</a>";
			
			$next = $index;
			if($next<$totalpage) $nav_next = "<a href=".$link."&page=".$next.">next</a>";
		}
		
		
		$navigator = '<div id="navigator">
						<div class = "left">'.$nav_prev.'</div>
						<div class = "right">'.$nav_next.'</div>
					  </div>';

		// set start and end indexing
		$start = $pglim*($indexpaging-1);	
		
		
		if($indexpaging==$totalpaging&&$lastdata!=$pglim) $end = $start+$lastdata;
		else $end = $start+$pglim;

		
		// show pagination index link	
		for($i=$start;$i<$end;$i++){
			
			if($page==$i) $pg_index .= '<div class="active">'.($i+1).'</div>'; 
			else $pg_index .= '<a href="'.$link.'&hal='.$i.'">'.($i+1).'</a>';
		}

		
		// set backward link
		$backward = $start-$pglim;
		if($backward>=0) $pg_back = "<a href=".$link."&hal=".$backward."><</a>";

		// set forward link
		$forward = $end;
		if($forward<$totalpage) $pg_skip = "<a href=".$link."&hal=".$forward.">></a>";

		if ($_GET['mod'] == 'listing' || ($_GET['mod'] == 'tools' && $_GET['do'] == 'detail')) $pagination = '<div id="pagination">'.$pg_back.$pg_index.$pg_skip.'<br/>'.$totaldata.' listing</div>';
		else if ($_GET['mod'] == 'news') $pagination = '<div id="pagination">'.$pg_back.$pg_index.$pg_skip.'<br/>'.$totaldata.' articles</div>';		
		else $pagination = '<div id="pagination">'.$pg_back.$pg_index.$pg_skip.'<br/>'.$totaldata.' data</div>';

		switch($tipe){			
			case "blogdesc":
				return $navigator;
			break; 			
			case "paging":
				return $pagination;
			break;			
			case "blogindex":
				default;
				return $navigator.$pagination;	
			break;
			
	    }
	
	}




  /**
   * journal::setOffset()
   * buat ngeset offset data berdasarkan paging
   * @param mixed $datalimit -- limit offsetnya
   * @return
   */
	public function setOffset($datalimit){
		
		
	
		
		$page = $_GET['hal'];
		
		if($page==""||$page==" "){
			$offset = "0";
		}
		else{
				$offset = $page * $datalimit;
		}

		$qOffset = " LIMIT ".$offset.", ".$datalimit." ";				

		return $qOffset;
	}
	
	 /**
   * display::regVars()
   * buat ngereset session
   * buat ngeset variable gettan
   * tambahkan filter handler database disini  
   * @return
   */
    private function regVars(){
		
		// reset session if in index page
		if("?".$_SERVER["QUERY_STRING"]==$this->pagelink){
			//if(isset($_SESSION['category'])) unset($_SESSION['category']);
		}
		else{
			
			// set session category and retrieve query string
			if(isset($_GET['item']))
			{ 
				$qFilter = " WHERE ".$this->table."_id = '".$_GET['item']."' ";
				return $qFilter;
			}		
			else{	
				
				// set session category and retrieve query string
				if(isset($_GET['cat']))	$_SESSION['category'] = $_GET['cat'];
				if(!empty($_SESSION['category']))	$term1 = $this->table.".".$this->table."_category_id = '".$_SESSION['category']."' ";
				
				$term = $term1;	
				if(!empty($term)) $qFilter = " WHERE ".$term;		
				return $qFilter;		
			}
				
		}
	}
	
	public function set_limit($data,$page){
		$this->datalimit = $data;
		$this->pagelimit = $page;		
	}


}

?>