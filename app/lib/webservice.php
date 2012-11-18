<?php
# Created By iAm[i]nE.
# www.iamine.com

class WebService {
	function isPost () {
		return strtolower ($_SERVER ['REQUEST_METHOD']) == 'post';
	}
	function isCallback () {
		return isset( $_GET['_a1_'] );
	}

	function load () {}
	function unload () {}
	
	function run () {
		$this->load ();
		$this->unload ();
	}
	
	function redirect($url) {
		header ('location: ' . $url);
		exit (0);
	}
}
