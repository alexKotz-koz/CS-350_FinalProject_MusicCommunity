<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';
$sessionLogin = $_SESSION['user_loggin_in'];

function displayAllBrowse($db){
    $selectAll = "SELECT * FROM userData";
    $selectAllStatement = $db->prepare($selectAll);
    $selectAllStatement->execute();
    $fetchAll = $selectAllStatement->fetchAll();
    return $fetchAll;
}

function uploadToUserAccount($db,$id,$songName,$songFile,$coverArt){
    $insert = "INSERT INTO userData (userSongName, userSongFile, userCoverArt, ownerID) VALUES (:userSongName,:userSongFile,:userCoverArt,:ownerID) WHERE ownerID = {$id}";
    $insertStatement=$db->prepart($insert);
    $insertStatement->bindValue(':userSongName',$songName);
    $insertStatement->bindValue(':userSongFile',$songFile);
    $insertStatement->bindValue(':userCoverArt',$coverArt);
    $insertStatement->bindValue(':ownerID',$id);
    $insertStatement->execute();
    $insertStatement->closeCursor();

}

