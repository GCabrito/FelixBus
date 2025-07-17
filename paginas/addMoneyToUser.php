<?php
    session_start(); // Inicia a sessão

    // Inclui o ficheiro de ligação à base de dados
    include ('../basedados/basedados.h');
    
    // Verifica se o utilizador está autenticado
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
        
    // Verifica se o utilizador tem permissões de admin ou funcionário
    } elseif (empty($_SESSION['admin']) && empty($_SESSION['funcionario'])) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.html";</script>');
    }
    
    // Escapa o valor recebido do formulário para evitar SQL Injection
    $value = $password = mysqli_real_escape_string($conn, $_POST['amount']);

    // Atualiza o saldo do utilizador selecionado
    $sql = "UPDATE utilizador
            SET saldo = saldo + '$value'
            WHERE email = '" .$_SESSION["getUserEmail"]."'";

    $result = mysqli_query($conn, $sql);

    // Verifica se o saldo foi atualizado com sucesso
    if(mysqli_affected_rows($conn) == 1) {
        // Limpa as variáveis de sessão relacionadas ao utilizador selecionado
        unset($_SESSION["getUserEmail"]);
        unset($_SESSION["getUserMoney"]);
        // Redireciona para a área de gestão
        echo ('<script>window.location.href = "managementArea.php"</script>');
    } else {
        // Limpa as variáveis de sessão e mostra mensagem de erro
        unset($_SESSION["getUserEmail"]);
        unset($_SESSION["getUserMoney"]);
        echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "managementArea.php"</script>');
    }
    mysqli_close($conn); // Fecha a ligação à base
?>