<?php
require("../model/account_db.php");
require("../model/userData_db.php");

$page = $_GET['page'];
$action = $_POST['action'] ?? NULL;

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
        }
    }catch (PDOException $e){
        $msg = $e->getMessage();
        echo "<p>ERROR: $msg</p>";
    }
}

function upload(){
    $dsn = 'mysql:host=localhost;dbname=cs_350';
    $username = 'student';
    $password = 'CS350';
    ///include read me for php.ini
    try{
        $db = new PDO($dsn,$username, $password);
        $file = $_FILES['uploadedSongFile'] ?? NULL;
        $coverArt = $_FILES['uploadedCoverArt'] ?? NULL;
        if($file){
            $tmpName = $file['tmp_name'];
            $tmpCoverName = $coverArt['tmp_name'];
            $fileName = $file['name'];
            $coverArtName = $coverArt['name'];
            $path = getcwd(). "\uploads\\". $fileName;
            $coverArtPath = getcwd()."\coverArt\\".$coverArtName;
            move_uploaded_file($tmpName, $path);
            move_uploaded_file($tmpCoverName, $coverArtPath);
            uploadToUserAccount($db,$fileName,$path, $coverArtName);
            if(isset($_SESSION['user_loggin_in']) === true){
                header("Location: ../view/browse_view.php");
            }
        }
    }catch (PDOException $e){
        $msg = $e->getMessage();
        echo "<p>ERROR: $msg</p>";
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