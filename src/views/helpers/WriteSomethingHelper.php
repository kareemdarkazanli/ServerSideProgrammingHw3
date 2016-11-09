<?php

namespace threemuskateers\hw3\views;

require_once "Helper.php";

class WriteSomethingHelper extends Helper {
	
    public function __construct() {
     
    }
	
    public function render($data) {
       $genres = $data['genres'];

       foreach($genres as $genre){
            if(in_array($genre, $data['genre']))
                    echo "<option selected value = $genre>$genre</option>";  
            else
                    echo "<option value = $genre>$genre</option>";  
                                
        }
	}

}
?>