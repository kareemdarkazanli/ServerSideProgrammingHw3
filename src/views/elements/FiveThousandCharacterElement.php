<?php

namespace threemuskateers\hw3\views;

require_once "Element.php";

class FiveThousandCharacterElement extends Element {
	
    public function __construct() {
     
    }
	
    public function render($data) {
    ?>
    <form class = "inline" method = "get" action = "index.php">
         <input class = "linkButton" type="submit" name = "navigate" value="Five Thousand Characters"/>
         <input type = 'hidden' name='c' value = 'landingpagecontroller'/>
		<input type = 'hidden' name='m' value = 'render'/>
    </form>
    
    <?php
	}
	
}
?>