<?php
include("top_view_logged_in.php");
?>
    <form action="../controller/index.php?page=upload" method="post" enctype="multipart/form-data">
        <label for="songFile">Song File: </label><input type="file" name="uploadedSongFile" id="songFile"><br>
        <label for="coverArt">Cover Art: </label><input type="file" name="uploadedCoverArt" id="coverArt">
        <input type="submit" name="submit" value="Upload">
        <input type="hidden" name="action" value="upload">
    </form>
<?php
include("bottom_view.php");