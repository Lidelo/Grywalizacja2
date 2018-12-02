<?php
$addedValue = $_GET['save'];
if(isset($addedValue)){
    include('connect.php');

    $query = "SELECT ".
    "login_user FROM users WHERE ".
    "login_user = '$username'";

    $result = mysqli_query($conn, $query);
    $singleRow = $result->fetch_assoc();
    $currentScore = $singleRow['score_user'];
    $newScore = $currentScore + intval($addedValue);

    $query = "UPDATE users ".
    "SET score_user = ".$newScore.
    " WHERE login_user = '".GLOBALS['login']."'";

    mysqli_query($conn, $query);

    $conn->close();
}
?>