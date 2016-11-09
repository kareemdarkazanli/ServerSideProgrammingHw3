<?php

namespace threemuskateers\hw3\views;

require_once "Helper.php";

class ReadAStoryHelper extends Helper {
	
    public function __construct() {
     
    }
	
    public function render($data) {
    if (isset($data['content'])){
			foreach($data['content'] as $lines){
				$arrayLines = explode("\r\n\r\n", $lines);
				foreach($arrayLines as $line){
					?>
					<p>
					<?=$line ?>
					</p>
					<?php
				}
			}}
	}
	
	public function renderRating($data) {
	for ($i = 1; $i <= 5; $i++){
		if ($i == $data['rating']){
			echo "<b>$i </b>";
		}
		else{
			echo $i." ";
		}
		}
	}
}
?>