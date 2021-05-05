<?php
if(isset($_SESSION['user_loggin_in'])=== true){
    include("top_view_logged_in.php");
}else{
    include("top_view_logged_out.php");
    ?>    <form action="../controller/index.php?page=createAccount" method="post">
        <label for="fullName">Name:             </label><input type="text" name="fullName" required><br>
        <label for="username">Username:         </label><input type="text" name="username" placeholder="Your Username" required><br>
        <label for="password">Password:         </label><input type="password" name="password" minlength="8" required><br>
        <label for="confirmPassword">Confirm Password: </label><input type="password" name="confirmPassword" minlength="8" required><br>
        <input type="submit" name ="submit"  value="Login">
        <input type="hidden" name="action" value="createAccount">
    </form> <?php
}
include("bottom_view.php");
?>

