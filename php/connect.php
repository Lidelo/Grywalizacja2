<?php
    define('dbuser', 'root');
    define('dbpass', '');
    define('dbserver', 'localhost');
    define('dbname', 'cos');
    $conn = mysqli_connect(dbserver, dbuser, dbpass, dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        console_log("Polaczono");
    }

    function console_log( $data ){
        echo '<script>console.log('. json_encode( $data ) .')</script></br>';
    }
?>