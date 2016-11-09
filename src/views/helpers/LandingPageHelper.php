<?php

namespace threemuskateers\hw3\views;

require_once "Helper.php";

class LandingPageHelper extends Helper {
	
    public function __construct() {
     
    }
	
    public function render($data) {
        foreach($data['genre'] as $genre){
            if($genre == $_SESSION['genre']){
                echo "<option value=$genre selected>$genre</option>";
            }
            else echo "<option value = $genre>$genre</option>";
        }
	}
	
	public function renderRated($data) {
        foreach($data['rated'] as $key => $value){
            echo "<li class='noStyle'>
            <form  method = 'get' action = 'index.php'>
			<input type = 'hidden' name='c' value = 'ReadAStoryController'/>
			<input type = 'hidden' name='m' value = 'render'/>
			<input class = 'linkButton' type='submit' name='storyLink' value='$value' />
            <input type = 'hidden' name='id' value = '$key'/>
            </form>
          </li>
         ";
        }
	}
	public function renderViewed($data) {
        foreach($data['viewed'] as $key => $value){
            echo "<li class='noStyle'>
            <form  method = 'get' action = 'index.php'>
			<input type = 'hidden' name='c' value = 'ReadAStoryController'/>
			<input type = 'hidden' name='m' value = 'render'/>
			<input class = 'linkButton' type='submit' name='storyLink' value='$value' />
            <input type = 'hidden' name='id' value = '$key'/>
            </form>
          </li>
         ";
        }
	}
	public function renderNewest($data) {
        foreach($data['newest'] as $key => $value){
            echo "<li class='noStyle'>
            <form  method = 'get' action = 'index.php'>
			<input type = 'hidden' name='c' value = 'ReadAStoryController'/>
			<input type = 'hidden' name='m' value = 'render'/>
			<input class = 'linkButton' type='submit' name='storyLink' value='$value' />
            <input type = 'hidden' name='id' value = '$key'/>
            </form>
          </li>
         ";
        }
	}
}
?>