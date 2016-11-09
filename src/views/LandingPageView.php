<?php

namespace threemuskateers\hw3\views;
use threemuskateers\hw3 as H;
require_once("src/views/helpers/LandingPageHelper.php");
require_once("src/views/elements/FiveThousandCharacterElement.php");
require_once(realpath(dirname(__FILE__) . '/../views/helpers/LandingPageHelper.php'));
require_once "View.php";
class LandingPageView extends View{

	private $landingPageHelper;
	private $fiveThousandCharacterElement;

    public function __construct(){
    	$this->landingPageHelper = new H\views\LandingPageHelper();
		$this->fiveThousandCharacterElement = new H\views\FiveThousandCharacterElement();
    
    }
    
    public function render($data)
    {  
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Five Thousand Characters</title>
            <link rel="stylesheet" type="text/css" href="./src/styles/landing_page.css"/>
        <head>
        <body>
        <div class = "centered" >
            <h1 >Five Thousand Characters</h1>
            
            <form  method = "get" action = "index.php">
                <input class = "linkButton"type="submit" name = "navigate" value="Write Something"/>
				<input type = 'hidden' name='c' value = 'WriteSomethingController'/>
				<input type = 'hidden' name='m' value = 'render'/>
            </form>
                        
            <h2>Check out what people are writing...</h2>
            <form  method = "get" action = "index.php">
                <input type = "text" name = "phraseFilter" value="<?php echo $data['phraseFilter'];?>" placeholder = "Phrase Filter">
                <select name= "genre" id="option">
                        <option value = "all" selected>All Genres</option>
                        <?php
							$this->landingPageHelper->render($data);
                        ?>
                </select>
                <input type="submit" value="Go"/>
                <h3>Highest Rated</h3>
                <ol>
                    <?php
							$this->landingPageHelper->renderRated($data);
                        ?>
                </ol>
                <h3>Most Viewed</h3>
                <ol>
                    <?php
							$this->landingPageHelper->renderViewed($data);
                        ?>
                </ol>
                <h3>Newest</h3>
                <ol>
                    <?php
							$this->landingPageHelper->renderNewest($data);
                        ?>
                </ol>
            </form>
        </div>        
        <body>

    </html>
<?php
    }
}
?>


