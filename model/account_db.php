<?php
session_start();
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

function validate($db,$user,$pass){
    $find = "SELECT * FROM accounts";
    echo$find;
    $findStatement = $db->prepare($find);
    $findStatement->execute();
    $users = $findStatement->fetchAll();
    foreach ($users as $i){
        if($i[3]==$user){
            $userPassword = $i[4];
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