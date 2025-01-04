<?php
    session_start();

    //ligar à base de dados
    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'FelixBus';

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT *
            FROM utilizador
            WHERE email = '$email' AND pass = '".hash('sha256', $password)."'";

    $result = mysqli_query($conn, $sql);

    if ($email == "admin@gmail.com" and $password == "admin") {
        $_SESSION['Admin'] = true;
        echo'<script>window.location.href = "index.php"</script>';
        exit;
    }

    if (mysqli_affected_rows($conn) > 0) {
        echo '<script>window.location.href = "index.php"</script>';
    } else {
        echo '<script> alert("Credenciais erradas");
              window.location.href = "login.html"</script>';
    }

    mysqli_close($conn);
?>