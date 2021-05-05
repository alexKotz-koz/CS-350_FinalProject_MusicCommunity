<?php
if(isset($_SESSION['user_loggin_in']) === true){
    include("top_view_logged_in.php");
    ?>
    <form action="../controller/index.php?page=upload" method="post" enctype="multipart/form-data">
        <label for="songFile">Song File: </label><input type="file" name="uploadedSongFile" id="songFile" required><br>
        <label for="coverArt">Cover Art: </label><input type="file" name="uploadedCoverArt" id="coverArt" required/>
        <input type="submit" name="submit" value="Upload">
        <input type="hidden" name="action" value="upload">
    </form><?php
}else{
    include("top_view_logged_out.php");
    header("Location: ../view/login_view.php");
}
include("bottom_view.php");
