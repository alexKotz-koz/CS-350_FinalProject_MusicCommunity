<?php
//model contents for accounts tbale
$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';
function insertAccount($db,$fullName,$favoriteArtist,$username,$password){
    $insert = "INSERT INTO accounts (fullName, favoriteArtist,username, password) VALUES ( :fullName,:favoriteArtist,:username,:password)";
    $insertStatement= $db->prepare($insert);
    $insertStatement->bindValue(':username',$username);
    $insertStatement->bindValue(':password',$password);
    $insertStatement->bindValue(':fullName',$fullName);
    $insertStatement->bindValue(':favoriteArtist',$favoriteArtist);
    $insertStatement->execute();
    $insertStatement->closeCursor();
}
function uploadToUserAccount($db,$id,$songName,$songFile,$coverArt){
    $insert = "INSERT INTO userData (userSongName, userSongFile, userCoverArt, ownerID) VALUES (:userSongName,:userSongFile,:userCoverArt,:ownerID)";
    $insertStatement=$db->prepart($insert);
    $insertStatement->bindValue(':userSongName',$songName);
    $insertStatement->bindValue(':userSongFile',$songFile);
    $insertStatement->bindValue(':userCoverArt',$coverArt);
    $insertStatement->bindValue(':ownerID',$id);
    $insertStatement->execute();
    $insertStatement->closeCursor();

}
function validate($db,$user,$pass): bool
{
    $find = "SELECT password FROM accounts WHERE username='{$user}'";
    $findStatement = $db->prepare($find);
    $findStatement->execute();
    $users = $findStatement->fetch();
    foreach ($users as $i){
        if(password_verify($i,$pass) === true){
            echo "<h1>Success</h1>";
            header("Location: ../view/home_view.php");
            return true;
        }
        else{
            return false;
        }
    }
    $findStatement->closeCursor();


}