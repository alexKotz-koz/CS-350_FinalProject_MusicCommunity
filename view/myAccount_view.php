<?php
include("top_view_logged_in.php");
require_once("../model/userData_db.php");

$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';
try{
    $db = new PDO($dsn,$username,$password);
    $userSongs = displayUserSongs($db);
    echo'
            <table>
            <tr>
            <td>Song Title</td>
            <td>Album Cover</td>
            </tr>
            ';
    foreach ($userSongs as $userData){
        $imageFilePath = "http://127.0.0.1:80/Homework/final/controller/coverArt/".$userData['userCoverArt'];

        echo"<tr><td>{$userData['userSongName']}</td>
            <td><img src='../controller/coverArt/{$userData['userCoverArt']}' width='100px' height='100px'></td>
            <td><audio controls><source id='source' src='../controller/uploads/{$userData['userSongFile']}' type='audio/wav'</audio>          
            <div class='delete'>
                <td class='td-delete'>
                    <a href='../controller/index.php?page=delete&id={$userData['id']}'>Delete</a>
                </td>
            </div>  
        </tr>";
    }
    '</table>';
}catch(PDOException $e){
    $msg = $e->getMessage();
    echo"<p>Error: $msg</p>";
}
include("bottom_view.php");