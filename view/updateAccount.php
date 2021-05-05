<?php
include ("top_view_logged_in.php");
require_once("../model/userData_db.php");

$dsn = 'mysql:host=localhost;dbname=cs_350';
$username = 'student';
$password = 'CS350';

$db = new PDO($dsn, $username, $password);
$method = $_SERVER['REQUEST_METHOD'];

$id = $_SESSION['userID'];
$userData = getAccountInfo($db, $id);
?>
<form method="POST">
    <label>Name: </label><input type="text" name="fullName" id="fullName" value="<?php echo $userData[0]['fullName'];?>" required><br>
    <input type="submit" value="Update Account">
    <input type="hidden" value="<?php echo $id;?>" name="id">
<?php
if($method == "POST"){
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    if(isset($fullName)){
        updateUser($db, $id, $fullName);
        header("Location: ../view/myAccount_view.php");
    }
}
include ("bottom_view.php");