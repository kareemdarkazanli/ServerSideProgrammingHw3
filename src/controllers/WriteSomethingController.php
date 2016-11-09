<?php

namespace threemuskateers\hw3\controllers;
require_once("Controller.php");
require_once("src/views/WriteSomethingView.php");
require_once(realpath(dirname(__FILE__) . '/../models/WriteSomethingModel.php'));
use threemuskateers\hw3 as B;

class WriteSomethingController extends Controller{

    private $writeSomethingModel;
    
    public function __construct() {
        $this->writeSomethingModel = new B\models\WriteSomethingModel();
    }
    
    function processRequest() {
            $view = new B\views\WriteSomethingView();


            if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Save"){
                
                $saveStory['identifier'] = filter_var($_REQUEST['identifier'], FILTER_SANITIZE_STRING);
                $saveStory['author'] = filter_var($_REQUEST['author'], FILTER_SANITIZE_STRING);
                $saveStory['title'] = filter_var($_REQUEST['title'], FILTER_SANITIZE_STRING);
                $saveStory['content'] = filter_var($_REQUEST['content'], FILTER_SANITIZE_STRING);
                $saveStory['genre'] = $_REQUEST['genre'];



                $data = $this->writeSomethingModel->saveStory($saveStory['identifier'], $saveStory['author'], $saveStory['genre'], $saveStory['title'], $saveStory['content']);
                $genres = array();
                $data['genres'] = $this->writeSomethingModel->getGenres();
                $view->render($data); 

            }
            else
            {
                $genres = array();
                $genres = $this->writeSomethingModel->getGenres();
                $user_selected_genres[0] = "Crime";
                $data['author'] = "";
                $data['title'] = "";
                $data['content'] = "";
                $data['identifier'] = "";
                $data['genre'] = $user_selected_genres;
                
                $data['genres'] = $genres;

                $view->render($data);
            }
    }
}

?>


