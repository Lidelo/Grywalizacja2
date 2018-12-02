<?php
    include ("connect.php");
if(isset($_POST["login"]))
    {
    if(isset($_POST["username"])){
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
    }
    if(isset($_POST["password"])){
        $password = hash('sha256', mysqli_real_escape_string($conn, $_POST["password"]));
    }

    $query = "SELECT ".
    "login_user, password_user FROM users WHERE ".
    "login_user = '$username' AND ".
    "password_user = '$password'";
    $wynik = mysqli_query($conn, $query);

    if(mysqli_num_rows($wynik) === 1){
        $GLOBALS['login'] = $username;
        setcookie("login", $username, time() + (86400 * 30), "/");
        header('Location: ../Web Journey/index.html');
        exit();
    } else {
        goToMainPage("Niepoprawny login lub hasło!");
        exit();
    }
    $conn->close();
}

function goToMainPage($message){
	echo '<script type="text/javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location.href = "../html/index.html";';
    echo '</script>';
}
?>