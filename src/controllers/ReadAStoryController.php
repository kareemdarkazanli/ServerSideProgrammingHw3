<?php

namespace threemuskateers\hw3\controllers;
require_once("Controller.php");
require_once("src/views/ReadAStoryView.php");
require_once(realpath(dirname(__FILE__) . '/../models/ReadAStoryModel.php'));
use threemuskateers\hw3 as B;

class ReadAStoryController extends Controller{

    private $ReadAStoryModel;
    
    public function __construct() {
        $this->ReadAStoryModel = new B\models\ReadAStoryModel();
    }
    function processRequest() {

        

			if (isset($_REQUEST['rating'])){
				$id = $_SESSION['id'];
				if(!filter_var($_REQUEST['rating'], FILTER_VALIDATE_INT) === false){
				    $this->ReadAStoryModel->addRating($id, $_REQUEST['rating']);
				    $rating = $_REQUEST['rating'];
				    $_SESSION['storyRated'][$id] = $rating;
				}
				else {
				    echo "Rating is not an integer";
				}
				

			}
			else {
				$id = $_REQUEST['id'];
				$rating = 0;
			}
			if (isset($_SESSION['storyRated'][$id])){
				$rating = $_SESSION['storyRated'][$id];
			}
			
			$data = $this->ReadAStoryModel->getData($id);
			
			$data['rating'] = $rating;
			$this->ReadAStoryModel->addView($id);
            $view = new B\views\ReadAStoryView();
            $view->render($data);

    }
}

?>


