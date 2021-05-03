<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';

$sessionLogin = $_SESSION['user_loggin_in'] ?? NULL;
$USER_NAME = $_SESSION['username'] ?? NULL;

//Account Users
function insertAccount($db,$fullName,$username,$password){
    $insert = "INSERT INTO accounts (fullName,username, password) VALUES ( :fullName,:username,:password)";
    $insertStatement= $db->prepare($insert);
    $insertStatement->bindValue(':username',$username);
    $insertStatement->bindValue(':password',$password);
    $insertStatement->bindValue(':fullName',$fullName);
    $insertStatement->execute();
    $insertStatement->closeCursor();
}
//Account Users
function validate($db,$user,$pass){
    $find = "SELECT * FROM accounts";
    $findStatement = $db->prepare($find);
    $findStatement->execute();
    $users = $findStatement->fetchAll();
    foreach ($users as $i){
        if($i[2]==$user){
            $userPassword = $i[3];
            if(password_verify($pass,$userPassword) === true){
                $_SESSION['user_loggin_in'] = true;
                $_SESSION['userID'] = $i[0];
                header("Location: ../view/myAccount_view.php");
            }
            else{
                echo "BAD INPUT";
            }
        }
    }
    $findStatement->closeCursor();
}
//User Data
function displayAllBrowse($db){
    $selectAll = "SELECT * FROM userData";
    $selectAllStatement = $db->prepare($selectAll);
    $selectAllStatement->execute();
    $fetchAll = $selectAllStatement->fetchAll();
    return $fetchAll;
}

// User Data
function uploadToUserAccount($db,$songName,$songFile,$coverArt){
    $userID = (string) $_SESSION['userID'];
    $insert = "INSERT INTO userdata (userSongName, userSongFile, userCoverArt, ownerID) VALUES(:userSongName,:userSongFile,:userCoverArt, :ownerID)";
    $insertStatement=$db->prepare($insert);
    $insertStatement->bindValue(':userSongName',$songName);
    $insertStatement->bindValue(':userSongFile',$songFile);
    $insertStatement->bindValue(':userCoverArt',$coverArt);
    $insertStatement->bindValue(':ownerID', $userID);
    $insertStatement->execute();
    $insertStatement->closeCursor();
}
// User Data
function displayUserSongs($db){
    $userID = (string) $_SESSION['userID'];
    $selectAll = "SELECT * FROM userdata WHERE ownerID={$userID}";
    $selectAllStatement = $db->prepare($selectAll);
    $selectAllStatement->execute();
    $fetchAll = $selectAllStatement->fetchAll();
    return $fetchAll;
}

