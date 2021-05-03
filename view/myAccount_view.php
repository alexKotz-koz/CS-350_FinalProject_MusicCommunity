<?php
include("top_view_logged_in.php");
require("../model/userData_db.php");
print_r($_SESSION);
if(isset($_SESSION['username'])){
    print_r($_SESSION);
}
echo "hello";
include("bottom_view.php");