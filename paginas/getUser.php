<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    
    // Verifica se o utilizador está autenticado
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    // Verifica se o utilizador tem permissões de admin ou funcionário
    } elseif (empty($_SESSION['admin']) && empty($_SESSION['funcionario'])) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }
    
    // Escapa o email recebido do formulário para evitar SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    // Procura o utilizador na base de dados pelo email
    $sql = "SELECT *
            FROM utilizador
            WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    // Se encontrou o utilizador, guarda dados na sessão e redireciona
    if (mysqli_affected_rows($conn) == 1) {
        while($row = mysqli_fetch_array($result)){
            $_SESSION['getUserEmail'] = $row['email'];
            $_SESSION['getUserMoney'] = $row['saldo'];
        }
        echo ('<script>window.location.href = "managementArea.php"</script>');
    } else {
        // Se não encontrou, limpa variáveis de sessão e mostra alerta
        unset($_SESSION['getUserEmail']);
        echo ('<script>alert("Não foi encontrado nenhum utilizador.");</script>');
        echo ('<script>window.location.href = "managementArea.php";</script>');
    }
        
    mysqli_close($conn); // Fecha a ligação à base de dados
?>