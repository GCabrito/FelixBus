<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    
    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Guarda o email na sessão
    $_SESSION["email"] = $email;

    // Prepara a query para verificar as credenciais do utilizador
    $sql = "SELECT *
            FROM utilizador
            WHERE email = '$email' AND pass = '".hash('sha256', $password)."'";

    $result = mysqli_query($conn, $sql);

    // Login rápido para utilizadores de teste (admin, funcionario, cliente)
    if ($email == "admin" && $password == "admin") {
        $_SESSION['admin'] = true;
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    } elseif ($email == "funcionario" && $password == "funcionario") {
        $_SESSION['funcionario'] = true;
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    } elseif ($email == "cliente" && $password == "cliente") {
        $_SESSION['cliente'] = true;
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    }

    // Verifica se encontrou algum utilizador com as credenciais fornecidas
    if (mysqli_affected_rows($conn) > 0) {
        while($row = mysqli_fetch_assoc($result)){

            // Verifica o estado da conta
            if ($row['estado'] === 'Pendente') {
                echo '<script> alert("Tem de esperar pela validação do admin")</script>';
                echo'<script>window.location.href = "login.html"</script>';
            } elseif ($row['estado'] === 'Inválido') {
                echo '<script> alert("Não pode entrar. A sua conta foi marcada como inválida")</script>';
                echo'<script>window.location.href = "login.html"</script>';
            }

            // Define o tipo de utilizador na sessão e redireciona
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
        // Se as credenciais estiverem erradas, mostra mensagem de erro
        echo '<script> alert("Credenciais erradas");
                window.location.href = "login.html"</script>';
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>