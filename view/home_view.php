<?php

if(isset($_SESSION['user_loggin_in'])===true){
    include("../view/top_view_logged_in.php");
    echo '<iframe src="https://open.spotify.com/embed/artist/67otCwDIJBAL4nw8yALkey" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';
}
else{
    include("../view/top_view_logged_out.php");
}



include("../view/bottom_view.php");