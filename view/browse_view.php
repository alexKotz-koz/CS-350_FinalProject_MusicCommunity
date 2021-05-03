<?php
include("top_view_logged_in.php");
require_once ("../model/userData_db.php");
$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';
try{
    $db = new PDO($dsn,$username,$password);
    $all = displayAllBrowse($db);
    echo'<table>
            <tr>
                <td>User</td>
                <td>Song Title</td>
                <td>Album Cover</td>
            </tr>
            ';
    foreach ($all as $userData){
        echo"<tr><td>{$userData['id']}</td> <td>{$userData['userSongName']}</td><td>{$userData['userCoverArt']}</td></tr>";
    }
    '</table>';
}catch(PDOException $e) {
    $msg = $e->getMessage();
    echo "<p>Error: $msg</p>";
}
include("bottom_view.php");