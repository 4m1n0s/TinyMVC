<?php
# Created By iAm[i]nE.
# www.iamine.com

require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH 	. 'index.php' );

class GPage extends Home {
    function GPage() {
        parent::Home();
        
        $this->viewFile = 'index.phtml';
    }
    
    function load() {
        parent::load();
        
    }
}

$p = new GPage();
$p->run();