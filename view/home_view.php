<?php
if(isset($_SESSION['user_loggin_in'])===true){
    include("../view/myAccount_view.php");
}
else{
    include("../view/login_view.php");
}
include("../view/bottom_view.php");