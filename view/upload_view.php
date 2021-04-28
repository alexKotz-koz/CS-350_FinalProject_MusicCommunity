<?php
include("top_view.php");
?>
    <form action="../controller/upload_controller.php" method="post" enctype="multipart/form-data">
        <label for="songName">Song Name: </label>
        <input type="text" name="songName" id="songName" required><br>
        <label for="songFile">Song File: </label>
        <input type="file" name="songFile" id="songFile" required><br>
        <label for="coverArt">Cover Art: </label>
        <input type="file" name="coverArt" id="coverArt">
        <input type="submit" name="submit">
        <input type="hidden" name="action" value="upload">
    </form>
<?php
include("bottom_view.php");