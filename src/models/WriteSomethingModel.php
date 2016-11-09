<?php

namespace threemuskateers\hw3\models;

require_once "Model.php";

class WriteSomethingModel extends Model {

    private $conn;
    /**
     * Constructor for UserModel is used to instanciate 
     * a connection to mysql
     */
    public function __construct() {
        $this->conn = $this->connectToDB();
    }
    
    public function saveStory($identifier, $author, $genres, $title, $content){
    
  
        $identifier_query = "SELECT * FROM STORIES WHERE identifier='$identifier'";
        
        $check =  $this->conn->query($identifier_query) ;
        $rowCount = $check->num_rows;
        //check to see if identifier exists
        
        //if it doesn't then add the contents to database
        if ($rowCount == 0){
            $sql = "INSERT INTO STORIES SET identifier='$identifier', author='$author', title='$title', content='$content'";
            $this->conn->query($sql) or die(mysqli_connect_errno() . "Data cannot be inserted, story is more than 500 words");
            foreach($genres as $genre){
                $sql = "INSERT INTO RELATION SET identifier='$identifier', genre='$genre'";
                $this->conn->query($sql) or die(mysqli_connect_errno() . "Data cannot inserted");
                $sql = "UPDATE GENRES SET numOfStories = numOfStories + 1 WHERE genre='$genre'";
                $this->conn->query($sql) or die(mysqli_connect_errno() . "Data cannot inserted");
            }
            
            $story=array();
            $story['author'] = $author;
            $story['title'] = $title;
            $story['content'] = $content;
            
             //Get the genre(s) of matching identifier
            $sql = "SELECT genre FROM RELATION WHERE identifier='$identifier'";
            $retrieve = mysqli_query($this->conn,$sql);
            if(!$retrieve) {
                die('Could not get data: ' . mysql_error());
            }
            $user_selected_genres = array(); 
            $i = 0;   
            while($row = mysqli_fetch_array($retrieve, MYSQLI_ASSOC)) {
                $user_selected_genres[$i] = $row['genre'];
                $i++;
            }
            $story['identifier'] = $identifier; 
            $story['genre'] = $user_selected_genres; 
            return $story; 
            
        } 
        
        //if identifier exists but all fields are empty
        else if (isset($identifier) && !empty($identifier) && empty($author) && empty($title) && empty($content)){
            //Get the author of matching identifier
            $sql = "SELECT author FROM STORIES WHERE identifier='$identifier'";
            $author = $this->conn->query($sql)->fetch_object()->author;
            $sql = "SELECT title FROM STORIES WHERE identifier='$identifier'";
            $title = $this->conn->query($sql)->fetch_object()->title;
            $sql = "SELECT content FROM STORIES WHERE identifier='$identifier'";
            $content = $this->conn->query($sql)->fetch_object()->content;
            $story=array();
            $story['author'] = $author;
            $story['title'] = $title;
            $story['content'] = $content;
            
            //Get the genre(s) of matching identifier
            $sql = "SELECT genre FROM RELATION WHERE identifier='$identifier'";
            $retrieve = mysqli_query($this->conn,$sql);
            if(!$retrieve) {
                die('Could not get data: ' . mysql_error());
            }
            $user_selected_genres = array(); 
            $i = 0;   
            while($row = mysqli_fetch_array($retrieve, MYSQLI_ASSOC)) {
                $user_selected_genres[$i] = $row['genre'];
                $i++;
            }
            
            $story['genre'] = $user_selected_genres; 
            $story['identifier'] = $identifier; 
            return $story;    
        }
        
        //if identifier exists and there is content in fields
        else{

        //Get the old genres
        $sql = "SELECT genre FROM RELATION WHERE identifier='$identifier'";
        $retrieve = mysqli_query($this->conn,$sql);
        if(!$retrieve) {
            die('Could not get data: ' . mysql_error());
        }
        $old_genres = array(); 
        $i = 0;   
        while($row = mysqli_fetch_array($retrieve, MYSQLI_ASSOC)) {
            $old_genres[$i] = $row['genre'];
            $i++;
        }
        
        
        //delete old genres from RELATION and decrement old genres by 1
        foreach($old_genres as $genre){
                $sql = "DELETE FROM RELATION WHERE identifier='$identifier' AND genre='$genre'";
                $this->conn->query($sql);
                $sql = "UPDATE GENRES SET numOfStories = numOfStories - 1 WHERE genre='$genre'";
                $this->conn->query($sql);
        }
        
        //Update stories with new data
            $sql = "UPDATE STORIES SET author='$author', title='$title', content='$content' WHERE identifier='$identifier'";
            $this->conn->query($sql) or die(mysqli_connect_errno() . "Data cannot be inserted, story is more than 500 words");
            

            foreach($genres as $genre){
                $sql = "INSERT INTO RELATION SET identifier='$identifier', genre='$genre'";
                $this->conn->query($sql);
                $sql = "UPDATE GENRES SET numOfStories = numOfStories + 1 WHERE genre='$genre'";
                $this->conn->query($sql);
            }
        
        
            $sql = "SELECT author FROM STORIES WHERE identifier='$identifier'";
            $author = $this->conn->query($sql)->fetch_object()->author;
            $sql = "SELECT title FROM STORIES WHERE identifier='$identifier'";
            $title = $this->conn->query($sql)->fetch_object()->title;
            $sql = "SELECT content FROM STORIES WHERE identifier='$identifier'";
            $content = $this->conn->query($sql)->fetch_object()->content;
            $story=array();
            
        
            $story['author'] = $author;
            $story['title'] = $title;
            $story['content'] = $content;
            
            $sql = "SELECT genre FROM RELATION WHERE identifier='$identifier'";
            $retrieve = mysqli_query($this->conn,$sql);
            if(!$retrieve) {
                die('Could not get data: ' . mysql_error());
            }
            $user_selected_genres = array(); 
            $i = 0;   
            while($row = mysqli_fetch_array($retrieve, MYSQLI_ASSOC)) {
                $user_selected_genres[$i] = $row['genre'];
                $i++;
            }
            
            $story['genre'] = $user_selected_genres; 
            $story['identifier'] = $identifier; 
            return $story;    
        }
        
        
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


}


?>


