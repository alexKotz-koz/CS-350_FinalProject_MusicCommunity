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
                header("Location: ../view/login_view.php");
            }
        }
        else{
            echo "Username or password was incorrect. Please try again";
            header("Location: ../view/login_view.php");
        }
    }
    $findStatement->closeCursor();
}
//User Data
function displayAllBrowse($db){
    $selectAll = "SELECT * FROM userData";
    $selectAllStatement = $db->prepare($selectAll);
    $selectAllStatement->execute();
    return $selectAllStatement->fetchAll();
}

// User Data
function uploadToUserAccount($db,$songName,$songFile,$coverArtPath){
    $userID = (string) $_SESSION['userID'];
    $insert = "INSERT INTO userdata (userSongName, userSongFile, userCoverArt, ownerID) VALUES(:userSongName,:userSongFile,:userCoverArt, :ownerID)";
    $insertStatement=$db->prepare($insert);
    $insertStatement->bindValue(':userSongName',$songName);
    $insertStatement->bindValue(':userSongFile',$songFile);
    $insertStatement->bindValue(':userCoverArt',$coverArtPath);
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
    return $selectAllStatement->fetchAll();
}

function getUserID($db){
    $selectName = "SELECT * FROM accounts JOIN userdata on accounts.id=userdata.ownerID";
    $selectNameStatement = $db->prepare($selectName);
    $selectNameStatement->execute();
    return $selectNameStatement->fetchAll();
}

function deleteSong($db,$id){
    $delete = "DELETE FROM userdata WHERE userdata.id={$id}";
    $deleteStatement = $db->prepare($delete);
    $deleteStatement->execute();
    $deleteStatement->closeCursor();
}

function getAccountInfo($db, $id){
    $select = "SELECT * FROM accounts WHERE id={$id}";
    $selectStatement = $db->prepare($select);
    $selectStatement->execute();
    return $selectStatement->fetchAll();
}

function updateUser($db, $id, $fullName){
    $update = "UPDATE accounts SET fullName=:fullName WHERE id={$id}";
    $updateStatement = $db->prepare($update);
    $updateStatement->bindValue(':fullName', $fullName);
    //$updateStatement->bindValue(':password', $newPassword);
    $updateStatement->execute();
}
