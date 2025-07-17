<?php
    session_start();
    include ('../basedados/basedados.h');
    
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $_SESSION["email"] = $email;

    $sql = "SELECT *
            FROM utilizador
            WHERE email = '$email' AND pass = '".hash('sha256', $password)."'";

    $result = mysqli_query($conn, $sql);

    if ($email == "admin" && $password == "admin") {
        $_SESSION['admin'] = true;
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    } elseif ($email == "funcionario" && $password == "funcionario") {
        $_SESSION['funcionario'] = true;
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    } elseif ($email = "cliente" && $password = "cliente") {
        $_SESSION['cliente'] = true;
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    }

    if (mysqli_affected_rows($conn) > 0) {
        while($row = mysqli_fetch_assoc($result)){

            if ($row['estado'] === 'Pendente') {
                echo '<script> alert("Tem de esperar pela validação do admin")</script>';
                echo'<script>window.location.href = "login.html"</script>';
            } elseif ($row['estado'] === 'Inválido') {
                echo '<script> alert("Não pode entrar. A sua conta foi marcada como inválida")</script>';
                echo'<script>window.location.href = "login.html"</script>';
            }

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
    } else {
        echo '<script> alert("Credenciais erradas");
                window.location.href = "login.html"</script>';
    }

    mysqli_close($conn);
?>