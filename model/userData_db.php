<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';
$sessionLogin = $_SESSION['user_loggin_in'] ?? NULL;

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
                header("Location: ../view/myAccount_view.php");
            }
            else{
                echo "BAD INPUT";
            }
        }
    }
    $findStatement->closeCursor();
}

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

