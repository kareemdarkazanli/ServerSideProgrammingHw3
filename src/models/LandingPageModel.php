<?php

namespace threemuskateers\hw3\models;

require_once "Model.php";

class LandingPageModel extends Model {

    private $conn;
    /**
     * Constructor for LandingPageModel is used to instantiate 
     * a connection to mysql
     */
    public function __construct() {
        $this->conn = $this->connectToDB();
    }
    
    public function getGenres(){
        $sql = 'SELECT genre FROM GENRES';
        $retval = mysqli_query($this->conn,$sql);
   
        if(!$retval ) {
            die('Could not get data: ' . mysql_error());
        }
        $genres = array(); 
        $i = 0;   
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $genres[$i] = $row['genre'];
            $i++;
        }
        return $genres;
    }

    public function getTopTenMostViewed($filter, $genre){
        if($genre == 'all'){
            $sql = "SELECT title, identifier FROM STORIES WHERE title LIKE '%$filter%' ORDER BY numOfViews DESC limit 10";
        }else{
            $sql = "SELECT title, STORIES.identifier FROM STORIES JOIN RELATION ON STORIES.identifier = RELATION.identifier AND RELATION.genre = '$genre' WHERE title LIKE '%$filter%' ORDER BY numOfViews DESC limit 10";
        }
        $retval = mysqli_query($this->conn,$sql);
        if(!$retval) {
            die('Could not get data: ' . mysql_error());
        }
        $mostViewed = array(); 
         
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $mostViewed[$row['identifier']] = $row['title'];
        }
        return $mostViewed;
    }

    public function getTopTenNewest($filter, $genre){
        if($genre == 'all'){
            $sql = "SELECT title, identifier FROM STORIES WHERE title LIKE '%$filter%' ORDER BY timeSubmitted DESC limit 10";
        }else{
            $sql = "SELECT title, STORIES.identifier FROM STORIES JOIN RELATION ON STORIES.identifier = RELATION.identifier AND RELATION.genre = '$genre' WHERE title LIKE '%$filter%' ORDER BY timeSubmitted DESC limit 10";
        }
        $retval = mysqli_query($this->conn,$sql);
        if(!$retval) {
            die('Could not get data: ' . mysql_error());
        }
        $newest = array(); 
          
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $newest[$row['identifier']] = $row['title'];
        }
        return $newest;
    }

    public function getTopTenHighestRated($filter, $genre){
        if($genre == 'all'){
             $sql = "SELECT title, identifier FROM STORIES WHERE title LIKE '%$filter%' ORDER BY (totalRatePoints/numOfRates) DESC limit 10";
        }else{
            $sql = "SELECT title, STORIES.identifier FROM STORIES JOIN RELATION ON STORIES.identifier = RELATION.identifier AND RELATION.genre = '$genre' WHERE title LIKE '%$filter%' ORDER BY (totalRatePoints/numOfRates) DESC limit 10";
        }
        $retval = mysqli_query($this->conn,$sql);
        if(!$retval) {
            die('Could not get data: ' . mysql_error());
        }
        $highestRated = array(); 

        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $highestRated[$row['identifier']] = $row['title'];
        }
        return $highestRated;

    }
	
	public function getData($filter, $genre){
        $data = array();
		$data['genre'] = $this->getGenres();
		$data['viewed'] = $this->getTopTenMostViewed($filter, $genre);
		$data['newest'] = $this->getTopTenNewest($filter, $genre);
		$data['rated'] = $this->getTopTenHighestRated($filter, $genre);
		return $data;
    }

}


?>


