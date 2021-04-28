<?php
require("../model/account_db.php");
require("../model/userData_db.php");

$page = $_GET['page'];
$action = $_POST['action'];

function createAccount(){
    $dsn = 'mysql:host=localhost;dbname=cs_350';
    $username = 'student';
    $password = 'CS350';

    $fullNameForm = $_POST['fullName'] ?? NULL;
    $favoriteArtist = $_POST['favoriteArtist'] ?? NULL;
    $usernameForm = $_POST['username'] ?? NULL;
    $passwordForm = $_POST['password'] ?? NULL;
    $confirmPassword = $_POST['confirmPassword'] ?? NULL;
    try{
        $db = new PDO($dsn, $username,$password);
        if (isset($usernameForm) && isset($passwordForm)){
            if($passwordForm !== $confirmPassword){
                echo "<p>Passwords do not match</p>";
            }
            else{
                $passwordForm = password_hash($passwordForm,PASSWORD_DEFAULT);
                insertAccount($db,$fullNameForm,$favoriteArtist,$usernameForm,$passwordForm);
                header("Location: ../view/home_view.php");
            }
        }
    }catch (PDOException $e){
        $msg = $e->getMessage();
        echo "<p>ERROR: $msg</p>";
    }
}

function login(){
    $dsn = 'mysql:host=localhost;dbname=cs_350';
    $username = 'student';
    $password = 'CS350';
    $usernameForm = $_POST['username'];
    $passwordForm = $_POST['password'];

    try {
        $db = new PDO($dsn,$username, $password);
        if(isset($usernameForm) && isset($passwordForm)){
            validate($db,$usernameForm,$passwordForm);
            if($_SESSION['user_loggin_in'] === true){
                header("Location: ../view/myAccount_view.php");
            }
            else{
                //change echo below to forward to error page
                echo'<h1>Login failed please try again</h1>';
            }
        }
    }catch (PDOException $e){
        $msg = $e->getMessage();
        echo "<p>ERROR: $msg</p>";
    }
}

function upload(){

    ///include read me for php.ini

    $songName = $_POST['songName'];
    $songFile = $_FILES['songFile'] ?? NULL;
    $coverArt = $_FILES['coverArt'] ?? NULL;

    if($songFile){

        if($_SESSION['user_loggin_in']===true){
            $tmpName = $songFile['tmp_name'];
            $fileName = $songFile['name'];
            echo $fileName;
            $path = getcwd()."/uploads/song/".$fileName;
            echo $tmpName, $path;
            move_uploaded_file($tmpName,$path);
            echo $_SESSION['user_loggin_in'];
            //header("Location: ../view/home_view.php");
        }

    } else{
        echo "Cant upload file";
    }




}

if($_SERVER['REQUEST_METHOD']=='GET'){
    switch ($page){
        case 'home':
            include("../view/home_view.php");
            break;
        case 'login':
            include("../view/login_view.php");
            break;
        case 'logout':
            session_unset();
            $_SESSION['user_loggin_in'] = false;
            include("../view/home_view.php");
            break;
        case 'upload':
            include("../view/upload_view.php");
            break;
        case 'browse':
            include("../view/browse_view.php");
            break;
        case 'createAccount':
            include("../view/createAccount_view.php");
            break;
        case 'myAccount':
            include("../view/myAccount_view.php");
            break;

    }
}
else if ($_SERVER['REQUEST_METHOD']=='POST'){
    switch ($action){
        case 'createAccount':
            createAccount();
            break;
        case 'login':
            login();
            break;
        case 'upload':
            upload();
            break;
    }


}