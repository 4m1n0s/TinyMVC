<?php
# Created By iAm[i]nE.
# www.iamine.com
require( LIB_PATH . 'mysql.php' );

class ModelBase extends MysqlModel {
	function ModelBase() {
		global $AppConfig;
		parent::MysqlModel();
		
		$this->provider->debug      = FALSE;
		$this->provider->properties = $AppConfig['db'];
	}
}
