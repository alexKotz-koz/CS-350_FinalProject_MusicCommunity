<?php
require("../model/account_db.php");
require("../model/userData_db.php");

include("../view/upload_view.php");

$id = 1;

$current_dir = getcwd();
$targetSong_dir = "/uploads/song/";
//$targetCover_dir = "/uploads/cover/";
$targetSong_file = $_FILES["songFile"]["name"];
//$targetCover_file = $_FILES["coverArt"]["name"];
$songFileTmpName  = $_FILES['songFile']['tmp_name'];
//$coverFileTmpName  = $_FILES['coverArt']['tmp_name'];
$uploadPathSong = $current_dir . $targetSong_dir . basename($targetSong_file);
//$uploadPathCover = $current_dir . $targetCover_dir . basename($targetCover_file);
if(isset($_POST['submit'])) {
    if (empty($errors)) {
        $didUploadSong = move_uploaded_file($songFileTmpName, $uploadPathSong);
 //       $didUploadCover = move_uploaded_file($coverFileTmpName, $uploadPathCover);

        if ($didUploadSong) {
            echo "The file " . basename($targetSong_file) . " has been uploaded";
        } else {
            echo "An error occurred. Please contact the administrator.";
        }


   /*     if ($didUploadCover) {
            echo "The file " . basename($targetCover_file) . " has been uploaded";
        } else {
            echo "An error occurred. Please contact the administrator.";
        }*/
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}


