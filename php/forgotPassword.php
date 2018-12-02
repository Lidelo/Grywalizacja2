<?php
if(isset($_POST["reset"])){
    include ("connect.php");
	$username = mysqli_real_escape_string($conn, $_POST['forgot-username']);
	$sql = "SELECT * FROM users WHERE login_user = '$username'";
	$res = mysqli_query($conn, $sql);
	if(mysqli_num_rows($res) == 1){
	    $row = mysqli_fetch_assoc($res);
	    $newPassword = randomPassword();
	    $newPasswordHashed = hash('sha256', $newPassword);
        $username = $row['login_user'];
        $mail = $row['mail_user'];
        $subject = "Zmiana hasła do portalu Grywalizacja";
        $message = "Witaj ". $username."!\n".
        "Oto Twoje nowe, losowe haslo: ".$newPassword."\n\nZespół portalu Grywalizacja!";
	    $sql = "UPDATE users SET password_user='$newPasswordHashed' WHERE login_user='$username'";
        if ($conn->query($sql) === TRUE) {
            mail("gabbx96@gmail.com", $subject, $message);
            goToMainPage("Poprawnie zmieniono hasło!");
        } else {
        goToMainPage("Coś poszło nie tak");
        }
	}else{
        goToMainPage("Coś poszło nie tak");
	}
}

function goToMainPage($message){
	echo '<script type="text/javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location.href = "../html/index.html";';
    echo '</script>';
}


function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
?>