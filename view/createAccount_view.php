<?php
include("top_view.php");
?>
<form action="../controller/index.php?page=createAccount" method="post">
    <label for="fullName">Name:             </label>
    <input type="text" name="fullName"><br>
    <label for="favoriteArtist">Favorite Artist: </label>
    <input type="text" name="favoriteArtist" placeholder="Enter one of your favorite artists"><br>
    <label for="username">Username:         </label>
    <input type="text" name="username" placeholder="Your Username" required><br>
    <label for="password">Password:         </label>
    <input type="password" name="password" required><br>
    <label for="confirmPassword">Confirm Password: </label>
    <input type="password" name="confirmPassword"><br>
    <input type="submit" name ="submit"  value="Login">
    <input type="hidden" name="action" value="createAccount">
</form>
<?php


include("bottom_view.php");
?>
