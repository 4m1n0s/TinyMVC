<?php 
# Created By iAm[i]nE.
# www.iamine.com


define('ROOT_PATH',     realpath(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR);
define('APP_PATH',      ROOT_PATH 	. 'app' 	. DIRECTORY_SEPARATOR);
define('MODEL_PATH',    ROOT_PATH 	. 'model' 	. DIRECTORY_SEPARATOR);
define('VIEW_PATH',     ROOT_PATH 	. 'views' 	. DIRECTORY_SEPARATOR);
define('LIB_PATH',      APP_PATH 	. 'lib' 	. DIRECTORY_SEPARATOR);

// set the error reporting value
error_reporting(E_ALL);

// kill magic quotes and set the script time out to be infinite
ignore_user_abort(TRUE);
set_time_limit(0);
@set_magic_quotes_runtime(FALSE);

// compress the output stream ( only if the client browser support gzip )
if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) 
	&& substr_count($_SERVER ['HTTP_ACCEPT_ENCODING'], 'gzip')) {
	ob_implicit_flush(0);
	@ob_start(array('ob_gzhandler',9)) && header('Content-Encoding: gzip');
}

// don't cache the pages
header ('Content-Type: text/html; charset=utf-8');
header ('Date: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT');
header ('Last-Modified: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header ('Cache-Control: no-store, no-cache, must-revalidate');
header ('Cache-Control: post-check=0, pre-check=0');
header ('Pragma: no-cache');
header ('Vary: Accept-Encoding');

// include the files
require (APP_PATH   . 'config.php');
require (LIB_PATH   . 'webservice.php');
require (LIB_PATH   . 'widget.php');
require (LIB_PATH   . 'webhelper.php');
require (MODEL_PATH . 'base.php');
require (APP_PATH 	. 'mywidgets.php');
?>