<?php
require("../model/userData_db.php");

$page = $_GET['page'];
$action = $_POST['action'] ?? NULL;
$usernameForm = $_POST['username'] ?? NULL;
$passwordForm = $_POST['password'] ?? NULL;
function createAccount(){
    $dsn = 'mysql:host=localhost;dbname=cs_350';
    $username = 'student';
    $password = 'CS350';

    $fullNameForm = $_POST['fullName'] ?? NULL;
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
                insertAccount($db,$fullNameForm,$usernameForm,$passwordForm);
                header("Location: ../view/home_view.php");
            }
        }
    }catch (PDOException $e){
        $msg = $e->getMessage();
        echo "<p>ERROR: $msg</p>";
    }
}

function login($usernameForm, $passwordForm) {

    $dsn = 'mysql:host=localhost;dbname=cs_350';
    $username = 'student';
    $password = 'CS350';

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

function upload($usernameForm){
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
            uploadToUserAccount($db, $fileName, $path, $coverArtName,$usernameForm);
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
            unset($usernameForm);
            unset($passwordForm);
            include("../view/login_view.php");
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
            login($usernameForm, $passwordForm);
            break;
        case 'upload':
            upload($usernameForm);
            break;
    }


}