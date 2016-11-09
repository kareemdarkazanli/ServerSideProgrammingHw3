<?php

namespace threemuskateers\hw3\views;
require_once "View.php";
require_once("src/views/helpers/WriteSomethingHelper.php");
require_once("src/views/elements/FiveThousandCharacterElement.php");

require_once(realpath(dirname(__FILE__) . '/../views/helpers/WriteSomethingHelper.php'));

use threemuskateers\hw3 as H;

class WriteSomethingView extends View{
	private $writeSomethingHelper;
    private $fiveThousandCharacterElement;
    
    public function __construct(){
    		$this->writeSomethingHelper = new H\views\WriteSomethingHelper();
        	$this->fiveThousandCharacterElement = new H\views\FiveThousandCharacterElement();

    }
    
    public function render($data)
    { 
    
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Five Thousand Characters - Write Something</title>
            <link rel="stylesheet" type="text/css" href="./src/styles/write_something.css"/>
        <head>
        <body>
        <div class = "centered">
            <?php
                  $this->fiveThousandCharacterElement->render($data); 
            ?>
            <h1 class = "inline"> - Write Something</h1>
            <form method = "get" action = "index.php">
				<input type = 'hidden' name='c' value = 'WriteSomethingController'/>
				<input type = 'hidden' name='m' value = 'render'/>
                <label for = "title">Title: </label>
                <input type = "text" id = "title" name = "title" value = "<?php echo $data['title'];?>">
                <label for = "author">Author: </label>
                <input type = "text" id = "author" name = "author" value = "<?php echo $data['author'];?>">
                <label for = "identifier">Identifier: </label>
                <input type = "text" id = "identifier" name = "identifier" value = "<?php echo $data['identifier'];?>">
                <label for = "genre">Genre: </label>
                <select multiple name= "genre[]" id="genre">
                        <?php
                           	$this->writeSomethingHelper->render($data); 
                        ?>
                </select>
                <br></br>
                <br>
                <label for = "content">Your Writing</label></br>
                <textarea name = "content" id = "content" rows="10" cols="50"><?php echo $data['content'];?></textarea>
                <input name = "navigate" value="Write Something" input type="hidden"/>    
                <br><input name="submit" type="submit" value="Reset"/>
                <input name = "submit" type="submit" value="Save"/></br>
            </form>
 
        </div>        
        <body>

    </html>
<?php
    }
}
?>


