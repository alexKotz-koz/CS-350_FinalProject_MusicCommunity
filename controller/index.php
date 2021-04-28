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
    //$login = $_SESSION['user_loggin_in'];
    $usernameForm = $_POST['username'];
    $passwordForm = $_POST['password'];
    //$id = $_GET['id'];
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

    $songName = $_POST['songName'];
    $songFile = $_POST['songFile'];
    $coverArt = $_POST['coverArt'];

    $tmp_songFile = $_FILES['songFile']['tmp_song'];
    $path = getcwd() . '/uploads';
    $name = $path . '/uploads' . $_FILES['songFile']['name'];
    $success = move_uploaded_file($tmp_songFile,$name);
    if($success){
        echo $name . 'has been uploaded';
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