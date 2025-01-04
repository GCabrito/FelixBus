<?php
    session_start();

    //ligar à base de dados
    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'FelixBus';

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(! $conn ){
        die('Could not connect: ' . mysqli_error($conn));
    }
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $_SESSION["email"] = $email;

    $sql = "SELECT *
            FROM utilizador
            WHERE email = '$email' AND pass = '".hash('sha256', $password)."'";

    $result = mysqli_query($conn, $sql);

    $sql = "SELECT tipoUtilizador
            FROM utilizador
            WHERE email = '$email' AND pass = '".hash('sha256', $password)."'";

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        if ($row['tipoUtilizador'] == 1) {
            $_SESSION['admin'] = true;
            echo'<script>window.location.href = "index.php"</script>';
            exit;
        } elseif ($row['tipoUtilizador'] == 2) {
            $_SESSION['funcionario'] = true;
            echo'<script>window.location.href = "index.php"</script>';
            exit;
        } elseif ($row['tipoUtilizador'] == 3) {
            $_SESSION['utilizador'] = true;
            echo'<script>window.location.href = "index.php"</script>';
            exit;
        }
    }

    if (mysqli_affected_rows($conn) > 0) {
        echo '<script>window.location.href = "index.php"</script>';
    } else {
        echo '<script> alert("Credenciais erradas");
              window.location.href = "login.html"</script>';
    }

    mysqli_close($conn);
?>