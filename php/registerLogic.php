<?php
if(isset($_POST["register"]))
{
    include ("connect.php");
    if( isset($_POST["username"]) ){
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $query = "SELECT ".
            "login_user FROM users WHERE ".
            "login_user = '$username'";
            $wynik = mysqli_query($conn, $query);
            if(mysqli_num_rows($wynik) >= 1) {
            echo '<script>alert("Istnieje już użytkownik o takim loginie!")</script>';
            echo '<script>window.location="../html/index.html"</script>';
            exit();
            }
    }
    if( isset($_POST["mail"]) ){
        $mail = mysqli_real_escape_string($conn, $_POST["mail"]);
            $query = "SELECT ".
            "mail_user FROM users WHERE ".
            "mail_user = '$mail'";
            $wynik = mysqli_query($conn, $query);
            if(mysqli_num_rows($wynik) >= 1) {
            echo '<script>alert("Istnieje już użytkownik o takim mailu!")</script>';
            echo '<script>window.location="../html/index.html"</script>';
            exit();
            }
    }
    if( isset($_POST["password"]) ){
        $password = hash('sha256', mysqli_real_escape_string($conn, $_POST["password"]));
    }
    $query = "INSERT INTO users (login_user, password_user, mail_user, score_user) ".
     "VALUES ('$username', '$password', '$mail', '0')";

    if ($conn->query($query) === TRUE) {
        echo '<script>alert("Zarejestrowano pomyslnie!")</script>';
        echo '<script>window.location="../html/index.html"</script>';
    } else {
    echo '<script>alert("Error' . $sql . '\n' . $conn->error . '")</script>';
        alertOK("Error: " . $sql . "<br>" . $conn->error);
    }
    $conn->close();
}
?>
