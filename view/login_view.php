<?php
include("top_view.php");
?>
    <form action="../controller/index.php?page=login" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit">
        <input type="hidden" name="action" value="login">
    </form>

<?php
include("bottom_view.php");