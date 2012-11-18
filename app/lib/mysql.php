<?php
class MysqlModel {
	var $provider;
	
	function MysqlModel() {
		$this->provider =  new MysqlProvider();
	}

	function dispose() {
		$this->provider->close();
	}
}

class MysqlResultSet {
	var $_result;
	var $row;
	
	function MysqlResultSet( $result ) {
		$this->_result 	= $result;
	}
	
	function next() {
		$this->row = mysql_fetch_array ($this->_result, MYSQL_ASSOC);
		$returnValue = ($this->row != NULL);
		if( !$returnValue ) {
			$this->free();
		}

		return $returnValue;
	}
	
	function free() {
		mysql_free_result ($this->_result);
		unset ($this->row);
	}
}

class MysqlProvider {
	var $debug = FALSE;
	var $properties;
	var $_conn 	= NULL;

	function open() {
		static $c;
		$this->_conn = &$c;

		if( $this->_conn != NULL ) {
			return TRUE;
		}
		
		// open the connection
		$this->_conn = mysql_connect (
			$this->properties['host'],
			$this->properties['user'], 
			$this->properties['password'] );
		if ( $this->_conn == NULL ) {
			return FALSE;
		}

		// select the database
		if ( mysql_select_db ($this->properties['database']) == NULL ) {
			return FALSE;
		}

		return TRUE;
	}
	
	function close() {
		if( $this->_conn == NULL ) {
			return;
		}

		// close the connection
		mysql_close ($this->_conn);
		$this->_conn = NULL;
	}

	function executeQuery ( $sqlStatement, $sqlParams = NULL ) {
		$this->_executeQuery ($sqlStatement, $sqlParams, 1);
	}
	function executeQuery2 ( $sqlStatement, $sqlParams = NULL ) {
		return $this->_executeQuery ($sqlStatement, $sqlParams, 2);
	}
	function fetchScalar ( $sqlStatement, $sqlParams = NULL ) {
		return $this->_executeQuery ($sqlStatement, $sqlParams, 3);
	}
	function fetchResultSet ( $sqlStatement, $sqlParams = NULL ) {
		return $this->_executeQuery ($sqlStatement, $sqlParams, 4);
	}
	function fetchRow ( $sqlStatement, $sqlParams = NULL ) {
		$result = $this->fetchResultSet ($sqlStatement, $sqlParams);
		if( !$result->next() ) {
			return NULL;
		}

		// copy the result into new array
		$data = array();
		foreach( $result->row as $k=>$v ) {
			$data[$k] = $v;
		}
		$result->free();
		
		return $data;
	}
	function executeBatchQuery ($batchStatement, $separator = ';') {
		$queryArray = explode ($separator, $batchStatement);
		for($i = 0, $count = sizeof ($queryArray); $i < $count; $i++) {
			$query = trim ($queryArray[$i]);
			if ($query != '') {
				$this->executeQuery ($query);
			}
		}
	}

	function _executeQuery( $sqlStatement, $sqlParams, $executionType ) {
		$this->open();

		if ($sqlParams != NULL && is_array ($sqlParams)) {
			$safe_params = array ();
			foreach ( $sqlParams as $paramValue ) {
				$safe_params [] = mysql_real_escape_string ($paramValue, $this->_conn);
			}
			$sqlStatement = vsprintf ($sqlStatement, $safe_params);
		}
		if ($this->debug) {
			echo $sqlStatement, '<hr/>';
		}

		$result = mysql_query ($sqlStatement, $this->_conn);
		switch( $executionType ) {
			case 1:
				return;
			case 2:
				return mysql_affected_rows ($this->_conn);
			case 3:	// fetch Single value
				$row = mysql_fetch_row ($result);
				$returnValue = $row[0];
				mysql_free_result ($result);
				return $returnValue;
			case 4:	// fetch resultSet
				return new MysqlResultSet ($result);
		}
	}
}