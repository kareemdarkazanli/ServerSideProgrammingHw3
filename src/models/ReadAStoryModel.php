<?php

namespace threemuskateers\hw3\models;

require_once "Model.php";

class ReadAStoryModel extends Model {

    private $conn;
    /**
     * Constructor for UserModel is used to instanciate 
     * a connection to mysql
     */
    public function __construct() {
        $this->conn = $this->connectToDB();
    }
	
	public function getDate($id){
        $sql = "SELECT timeSubmitted FROM stories WHERE identifier='$id'";
        $retval = mysqli_query($this->conn,$sql);
   
        if(!$retval ) {
            die('Could not get data: ' . mysql_error());
        }
        $dates = array(); 
        $i = 0;   
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $dates[$i] = $row['timeSubmitted'];
            $i++;
        }
		foreach($dates as $date){
			return $date;
		}
    }
	
	public function getAuthor($id){
        $sql = "SELECT author FROM stories WHERE identifier='$id'";
        $retval = mysqli_query($this->conn,$sql);
   
        if(!$retval ) {
            die('Could not get data: ' . mysql_error());
        }
        $authors = array(); 
        $i = 0;   
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $authors[$i] = $row['author'];
            $i++;
        }
		$author = "";
		foreach($authors as $auth){
			$author = $author." ".$auth;
		}
        return $author;
    }
	
	public function getStory($id){
        $sql = "SELECT content FROM stories WHERE identifier='$id'";
        $retval = mysqli_query($this->conn,$sql);
   
        if(!$retval ) {
            die('Could not get data: ' . mysql_error());
        }
        $story = array(); 
        $i = 0;   
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $story[$i] = $row['content'];
            $i++;
        }
        return $story;
    }
	
	public function getAverageRating($id){
        $sql = "SELECT totalRatePoints FROM stories WHERE identifier='$id'";
        $retSum = mysqli_query($this->conn,$sql);
		$sql = "SELECT numOfRates FROM stories WHERE identifier='$id'";
		$retTotal = mysqli_query($this->conn,$sql);
   
        if(!$retSum ) {
            die('Could not get data: ' . mysql_error());
        }
		if(!$retTotal ) {
            die('Could not get data: ' . mysql_error());
        }
		$total = array();
        $sum = array(); 
        $i = 0;   
        while($row = mysqli_fetch_array($retSum, MYSQLI_ASSOC)) {
            $sum[$i] = $row['totalRatePoints'];
            $i++;
        }
		$i = 0;   
        while($row = mysqli_fetch_array($retTotal, MYSQLI_ASSOC)) {
            $total[$i] = $row['numOfRates'];
            $i++;
        }
		$sumVal;
		$totalVal;
		foreach($sum as $sums){
			$sumVal = $sums;
		}
		foreach($total as $totals){
			$totalVal = $totals;
		}
		if($totalVal != 0){
        return $sumVal / $totalVal;
		}
		else{
			return "No Ratings Yet";
		}
    }
	
	public function addRating($id, $rating){
        $sql = "UPDATE stories SET totalRatePoints = totalRatePoints + '$rating', timeSubmitted = timeSubmitted WHERE identifier='$id'";
        $retval = mysqli_query($this->conn,$sql);
		$sql = "UPDATE stories SET numOfRates = numOfRates + 1, timeSubmitted = timeSubmitted WHERE identifier='$id'";
		$retval = mysqli_query($this->conn,$sql);
    }
	
	public function addView($id){
        $sql = "UPDATE stories SET numOfViews = numOfViews + 1, timeSubmitted = timeSubmitted WHERE identifier='$id'";
        $retval = mysqli_query($this->conn,$sql);
    }

	public function getTitle($id){
        $sql = "SELECT title FROM stories WHERE identifier='$id'";
        $retval = mysqli_query($this->conn,$sql);
   
        if(!$retval ) {
            die('Could not get data: ' . mysql_error());
        }
        $titles = array(); 
        $i = 0;   
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $titles[$i] = $row['title'];
            $i++;
        }
		foreach($titles as $title){
			return $title;
		}
    }
	
	public function getData($id){
        $data = array();
		$data['id'] = $id;
		$data['title'] = $this->getTitle($id);
		$data['author'] = $this->getAuthor($id);
		$data['content'] = $this->getStory($id);
		$data['timeSubmitted'] = $this->getDate($id);
		$data['average'] = $this->getAverageRating($id);
		return $data;
    }
}


?>


