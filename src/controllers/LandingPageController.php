<?php

namespace threemuskateers\hw3\controllers;
require_once("Controller.php");
require_once("src/views/LandingPageView.php");
require_once(realpath(dirname(__FILE__) . '/../models/LandingPageModel.php'));
use threemuskateers\hw3 as B;

class LandingPageController extends Controller{

    private $landingPageModel;
    
    public function __construct() {
        $this->landingPageModel = new B\models\LandingPageModel();
    }
    
    function processRequest() {

    		$genres = array();
    		$mostViewed = array();
    		$newest = array();
            $genres = $this->landingPageModel->getGenres();
            $view = new B\views\LandingPageView();

            if(!isset($_REQUEST['phraseFilter'])){
            	$_REQUEST['phraseFilter'] = "";
            	if(!isset($_SESSION['phraseFilter'])){
            	    $_SESSION['phraseFilter'] = "";
            	}
            	if(!isset($_SESSION['genre'])){
            	    $_SESSION['genre'] = "";
            	}
                
            }else{
                if(isset($_REQUEST['navigate']) && $_REQUEST['navigate'] == "Five Thousand Characters"){

                }
                else{
                    $_SESSION['phraseFilter'] = $_REQUEST['phraseFilter'];
                    $_SESSION['genre'] = $_REQUEST['genre'];
                }

            }
            //echo 
			$data = $this->landingPageModel->getData($_REQUEST['phraseFilter'], $_REQUEST['genre']);
			$data['phraseFilter'] = $_SESSION['phraseFilter'];

            $view->render($data);
    }

}

?>


