<?php
# Created By iAm[i]nE.
# www.iamine.com

// the user interface classes
class MyWidget extends Widget {
    function MyWidget() {
		// start the session
		session_start ();
    }
}

/**
* Home View
*/
class Home extends MyWidget {
	function Home() {
		parent::MyWidget();

		$this->layoutViewFile = 'index.phtml';
	}
}
?>