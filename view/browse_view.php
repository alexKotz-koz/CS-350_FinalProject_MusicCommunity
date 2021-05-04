<?php
if ($_SESSION['user_loggin_in']===true){
    include("top_view_logged_in.php");
} else {
    include("top_view_logged_out.php");
}

require_once ("../model/userData_db.php");
$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';
try{
    $db = new PDO($dsn,$username,$password);
    $all = displayAllBrowse($db);
    $userID = getUserID($db);
    echo'<table>
            <tr>
                <td>User</td>
                <td>Song Title</td>
                <td>Album Cover</td>
                <td>Owner ID</td>
            </tr>
            ';
    foreach ($userID as $userData){
        echo"<tr><td>{$userData['fullName']}</td>
            <td>{$userData['userSongName']}</td>
            <td><img src='../controller/coverArt/{$userData['userCoverArt']}' width='100px' height='100px'></td>
            <td>{$userData['ownerID']}</td></tr>";
    }

    '</table>';
}catch(PDOException $e) {
    $msg = $e->getMessage();
    echo "<p>Error: $msg</p>";
}
include("bottom_view.php");