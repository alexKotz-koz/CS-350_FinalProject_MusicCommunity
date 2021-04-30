<?php
//session_start();
$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';
$sessionLogin = $_SESSION['user_loggin_in'] ?? NULL;

function displayAllBrowse($db){
    $selectAll = "SELECT * FROM userData";
    $selectAllStatement = $db->prepare($selectAll);
    $selectAllStatement->execute();
    $fetchAll = $selectAllStatement->fetchAll();
    return $fetchAll;
}

function uploadToUserAccount($db,$songName,$songFile,$coverArt){
    $insert = "INSERT INTO userData (userSongName, userSongFile, userCoverArt) VALUES (:userSongName,:userSongFile,:userCoverArt)";
    $insertStatement=$db->prepare($insert);
    $insertStatement->bindValue(':userSongName',$songName);
    $insertStatement->bindValue(':userSongFile',$songFile);
    $insertStatement->bindValue(':userCoverArt',$coverArt);
    $insertStatement->execute();
    $insertStatement->closeCursor();

}

