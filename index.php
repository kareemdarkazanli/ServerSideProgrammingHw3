<?php

namespace threemuskateers\hw3;
session_start();

require_once "src/controllers/LandingPageController.php";
require_once "src/controllers/WriteSomethingController.php";
require_once "src/controllers/ReadAStoryController.php";

//use threemuskateers\hw3\LandingPageController;
//defines for various namespaces
define("NS_BASE", "threemuskateers\\hw3\\");
define(NS_BASE . "NS_CONTROLLERS", "threemuskateers\\hw3\\controllers\\");
define(NS_BASE . "NS_VIEWS", "threemuskateers\\hw3\\views\\");
//$allowed_controllers = ["LandingPageController", "WritingSomething"];
if(isset($_REQUEST['navigate']) && $_REQUEST['navigate'] == "Write Something"){
    $controller_name = NS_CONTROLLERS . "WriteSomethingController"; //instantiate controller for request
}
else if(isset($_REQUEST['storyLink']) || isset($_REQUEST['rating'])){
	$controller_name = NS_CONTROLLERS . "ReadAStoryController"; //instantiate controller for request
}
else{
    if(!isset($_REQUEST['genre']) or empty($_REQUEST['genre'] or $_REQUEST['genre'] == 'all')){
    		$_REQUEST['genre'] = 'all';
    }
    $controller_name = NS_CONTROLLERS . "LandingPageController";
}

    //$controller_name = "hw3\controllers\LandingPageController";
    $controller = new $controller_name();
    $controller->processRequest();



?>