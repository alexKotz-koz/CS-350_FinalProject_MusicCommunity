<?php
include("top_view_logged_in.php");
?>
    <form action="../controller/index.php?page=upload" method="post" enctype="multipart/form-data">
        <label for="songName">Song Name: </label>
        <input type="text" name="songName" id="songName"><br>
        <label for="songFile">Song File: </label>
        <input type="file" name="songFile" id="songFile"><br>
        <label for="coverArt">Cover Art: </label>
        <input type="file" name="coverArt" id="coverArt">
        <input type="submit" name="submit">
        <input type="hidden" name="action" value="upload">
    </form>
<?php
include("bottom_view.php");