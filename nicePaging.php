<?php

Class nicePaging {

	private $_pdo,
			$_query,
			$_totalRows,
			$_totalPages,
			$_page,
			$_separator,
			$_maxPages,
			$_results;

	public function  __construct(PDO $pdo) {

		try {

			$this->_pdo = $pdo;
			$this->_separator = "?";
			$this->_maxPages = 10;

		} catch ( PDOException $e ) {

			die( $e->getMessage() );
		}
	}

	public function setSeparator($char) {
		$this->_separator = $char;
	}

	public function setMaxPages($maxPages) {
		$this->_maxPages = $maxPages;
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

} //end of class nicePaging
