<?php

namespace threemuskateers\hw3\views;
use threemuskateers\hw3 as H;
require_once("src/views/helpers/ReadAStoryHelper.php");
require_once("src/views/elements/FiveThousandCharacterElement.php");
require_once(realpath(dirname(__FILE__) . '/../views/helpers/ReadAStoryHelper.php'));
require_once "View.php";

class ReadAStoryView extends View{

	private $readAStoryHelper;
	private $fiveThousandCharacterElement;

	
    public function __construct(){
		$this->readAStoryHelper = new H\views\ReadAStoryHelper();
		$this->fiveThousandCharacterElement = new H\views\FiveThousandCharacterElement();

    }
    
    public function render($data)
    { 
	$_SESSION['id'] = $data['id'];
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Five Thousand Characters - <?=$data['title'] ?></title>
            <link rel="stylesheet" type="text/css" href="./src/styles/read_a_story.css">
        <head>
        <body>
        <div class = "centered">
            <?php
                  $this->fiveThousandCharacterElement->render($data); 
            ?>
            <h1 class = "inline"> - <?=$data['title'] ?></h1>
			<br></br>
			Author: <?php
				echo $data['author'];
			?>
			<br></br>
			Date Saved: <?php
				echo $data['timeSubmitted'];
			?>
			<br></br>
			Your Rating: 
			<?php
			if ($data['rating'] > 0){
			?>
			<br></br>
			<?php
				$this->readAStoryHelper->renderRating($data);
			}
			else {
			?>
			<br></br>
			<form  method = "get" action = "index.php">
                <input class = "linkButtonInner"type="submit" name = "rating" value="1"/>
                <input class = "linkButtonInner"type="submit" name = "rating" value="2"/>
                <input class = "linkButtonInner"type="submit" name = "rating" value="3"/>
                <input class = "linkButtonInner"type="submit" name = "rating" value="4"/>
                <input class = "linkButtonInner"type="submit" name = "rating" value="5"/>
				<input type = 'hidden' name='c' value = 'ReadAStoryController'/>
				<input type = 'hidden' name='m' value = 'render'/>
            </form>
			<?php
			}
			?>
			<br></br>
			Average Rating:  <?php
				echo $data['average'];
			?>
			<br></br>
			Story:
			<br></br>
			<?php
			$this->readAStoryHelper->render($data);
			?>
        </div>        
        <body>

    </html>
<?php
    }
}
?>


