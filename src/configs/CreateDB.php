<?php

namespace threemuskateers\hw3\configs;


require_once "Config.php";

//Establish connection to database
$conn = mysqli_connect(DEFHOST,"root", "");
//$conn = mysqli_connect(DEFHOST,DEFUSER, DEFPWD);
//"127.0.0.1"
//$conn = new mysqli(HOST, USER, PWD, "");
//Check connection was successful
if($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "\n";
}
//Create the database
$sql = "CREATE DATABASE " . DB;
if($conn->query($sql) === TRUE) {
    echo "Database " . DB . " created successfully \n";
} else {
    //echo "Error creating database: " . $conn->error . "\n";
}
//select the correct DB
$conn->select_db(DB);





//Create a new table for genres with genre and # of stories
$sql = "CREATE TABLE GENRES(
    genre VARCHAR(100) PRIMARY KEY NOT NULL,
    numOfStories INT(11) DEFAULT 0)"; 
if ($conn->query($sql) === TRUE) {
    echo "Table GENRES created successfully \n";
} else {

    //echo "Error creating table: " . $conn->error . "\n";
}





//Create a new table for stories with genre, title, content, date, # of views, and id
$sql = "CREATE TABLE STORIES(
    identifier VARCHAR(100) PRIMARY KEY NOT NULL,
    author VARCHAR(100),
    title VARCHAR(100),
    content VARCHAR(100),
    timeSubmitted TIMESTAMP NOT NULL,
    numOfViews INT(11) DEFAULT 0,
    totalRatePoints INT(11) DEFAULT 0,
    numOfRates INT(11) DEFAULT 0)"; 

if ($conn->query($sql) === TRUE) {
    echo "Table STORIES created successfully \n";
} else {
    //echo "Error creating table: " . $conn->error . "\n";
}

$sql = "INSERT INTO STORIES (identifier, author,  title, content) VALUES ('jkrowling', 'J.K. Rowling', 'Harry Potter', 'There was once a boy...'), ('drseuss', 'Dr. Seuss', 'Horton Hears a Who', 'There was once an elephant...');"; 
$conn->query($sql);



//Create a new table for ratings with id of the story, time of rating and rating score
$sql = "CREATE TABLE RELATION(
    identifier VARCHAR(100),   
    CONSTRAINT fk_id FOREIGN KEY (identifier) REFERENCES STORIES (identifier),
    genre VARCHAR(100),
    CONSTRAINT fk_genre FOREIGN KEY (genre) REFERENCES GENRES (genre))"; 

if ($conn->query($sql) === TRUE) {
    echo "Table RELATION created successfully \n";
} else {
    //echo "Error creating table: " . $conn->error . "\n";
}  



//Insert into GENRES
$sql = "INSERT INTO GENRES VALUES ('Crime',0),('Drama',0),('Horror',0),('Fiction',1),('Romance',0),('Comedy',1);"; 
$conn->query($sql);

$sql = "INSERT INTO RELATION VALUES ('jkrowling', 'Fiction'), ('drseuss', 'Comedy');"; 
$conn->query($sql);

$conn->close();


?>


