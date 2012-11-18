<?php
# Created By iAm[i]nE.
# www.iamine.com

class Widget extends WebService {
	var $viewFile;
	var $layoutViewFile = NULL;

	
	function printContent () {
		require( VIEW_PATH . $this->viewFile );
	}

	function preRender () {}
	
	function run () {
		$this->load ();
		$this->preRender ();

		// include the view page
		require (VIEW_PATH . ( $this->layoutViewFile == NULL? $this->viewFile : $this->layoutViewFile));

		$this->unload ();
		unset ($this);
	}
}
