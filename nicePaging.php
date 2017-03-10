<?php

Class nicePaging {

	private static $_instance = null;
	
<<<<<<< HEAD
	/**
	 * Constructor
	 *
	 * @access public
	 * @param connection The database connection link (default=NULL)
	 */
	public function __construct(PDO $conn=null){
		try {
			$this->conn=$conn;
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

			$this->separator="?";
			$this->maxPages=10;

		} catch (PDOException $e) {
			die($e->getMessage());
		}
		
=======
	private $_pdo,
			$_query,
			$_totalRows,
			$_totalPages,
			$_page,
			$_separator,
			$_maxPages,
			$_results;

	private function  __construct() {

		try {

			$this->_pdo = new PDO ( Config::getDbType().":host=". Config::getHost() ."; dbname=". Config::getDbname()."", Config::getUser(), Config::getPass()); 
			$this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->_separator = "?";
			$this->_maxPages = 10;
			
		} catch ( PDOException $e ) {

			die( $e->getMessage() );
		}
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f
	}

	public function setSeparator($char) {
		$this->_separator = $char;
	}

	public function setMaxPages($maxPages) {
		$this->_maxPages = $maxPages;
	}
<<<<<<< HEAD
	
	/**
	 * Method for limitting query result based on the requested page and rows per page 
	 *
	 * @access public
	 * @param string $sql The SQL string (without LIMIT)
	 * @param integer $rowsPerPage Displayed rows per page
	 * @return resultset Resultset from query
	 */
	public function pagerQuery($sql, $rowsPerPage){
		$page=isset($_GET['page']) ? $_GET['page'] : 1;
		
		if ($query = $this->conn->prepare($sql) ) {
					
			if ($query->execute()) {
				$results = $query->fetchAll( PDO::FETCH_OBJ );
				$totalRows = $query->rowCount();
			} 
		}

		$this->totalPages=intval($totalRows/$rowsPerPage) + ($totalRows%$rowsPerPage==0 ? 0 : 1);
		if($this->totalPages<1){
			$this->totalPages=1;
=======

	public static function getInstance() {

		if (!isset( self::$_instance )) {

			self::$_instance = new nicePaging();
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f
		}

		return self::$_instance;
	}

	public function query($sql, $rowsPerPage) {

		$page = isset($_GET['page']) ? $_GET['page'] : 1;

		if ($query = $this->_pdo->prepare($sql) ) {
					
			if ($query->execute()) {
				$results = $query->fetchAll( PDO::FETCH_OBJ );
				$this->_totalRows = $query->rowCount();
			} 
		}

		$this->_totalPages = intval($this->_totalRows / $rowsPerPage) + ($this->_totalRows % $rowsPerPage == 0 ? 0 : 1);
		if ($this->_totalPages < 1) {
			$this->_totalPages = 1;
		}

		$this->_page = intval($page);
		if ($this->_page < 1){
			$this->_page = 1;
		}
		
<<<<<<< HEAD
		$outputRes = $this->conn->prepare($sql." LIMIT ".$this->page*$rowsPerPage.", ".$rowsPerPage);
		if ($outputRes->execute()) {
			$results = $outputRes->fetchAll( PDO::FETCH_OBJ );
		}

		$this->page+=1;
		return $results;
=======
		if($this->_page > $this->_totalPages){
			$this->_page = $this->_totalPages;
		}

		$this->_page -= 1;
		if ($this->_page < 0) {
		 	$this->_page = 0;
		}

		$this->_query = $this->_pdo->prepare($sql." LIMIT ".$this->_page*$rowsPerPage.", ".$rowsPerPage);
			if ($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll( PDO::FETCH_OBJ );
				// $this->_totalRows = $this->_query->rowCount();
			} 
						
		$this->_page += 1;
		return $this->_results;

		//close database connection
		// $this->_pdo = null;
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f
	}

		
	public function createPaging($link){
		$start = ((($this->_page % $this->_maxPages == 0) ? ($this->_page / $this->_maxPages) : intval($this->_page / $this->_maxPages)+1)-1) * $this->_maxPages+1;
		$end = ((($start + $this->_maxPages-1 ) <= $this->_totalPages) ? ($start + $this->_maxPages -1 ) : $this->_totalPages);
		
		$paging='<ul class="nice_paging">';
		if ($this->_page>1){
			$paging.='<li><a href="'.$link.$this->_separator.'page=1" title="First page">&lt;&lt;</a></li>';
			$paging.='<li><a href="'.$link.$this->_separator.'page='.($this->_page -1).'" title="Previous page">&lt;</a></li>';
		}
		
		if ($start>$this->_maxPages){
			$paging.='<li><a href="'.$link.$this->_separator.'page='.($start-1).'" title="Page '.($start-1).'">...</a></li>';
		}
		
		for($i = $start; $i <= $end; $i++){
			if ($this->_page == $i){
				$paging.='<li class="current">'.$i.'</li>';
			}
			else{
				$paging.='<li><a href="'.$link.$this->_separator.'page='.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
			}
		}
		
		if ($end < $this->_totalPages){
			$paging.='<li><a href="'.$link. $this->_separator.'page='.($end+1).'" title="Page '.($end+1).'">...</a></li>';
		}
		
		if ($this->_page<$this->_totalPages){
			$paging.='<li><a href="'.$link.$this->_separator.'page='.($this->_page+1).'" title="Next page">&gt;</a></li>';
			$paging.='<li><a href="'.$link.$this->_separator.'page='.$this->_totalPages.'" title="Last page">&gt;&gt;</a></li>';
		}
		
		return $paging;
	}
<<<<<<< HEAD
}

?>
=======

} //end of class nicePaging


?>
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f
