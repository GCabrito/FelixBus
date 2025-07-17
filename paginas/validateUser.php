<?php
    session_start(); // Inicia a sessão do utilizador
    
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    
    // Verifica se o utilizador está autenticado
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif ($_SESSION['admin'] == false) {
        // Verifica se o utilizador tem permissões de admin
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }
    
    // Verifica se o id do utilizador foi recebido via POST
    if (isset($_POST['idUtilizador'])) {
        $idUtilizador = mysqli_real_escape_string($conn, $_POST['idUtilizador']);

        // Atualiza o estado do utilizador para 'Válido'
        $sql = "UPDATE utilizador
                SET estado = 'Válido'
                WHERE idUtilizador = '$idUtilizador'";

        $result = mysqli_query($conn, $sql);

        // Se a atualização foi bem sucedida, redireciona para a área de administração
        if (mysqli_affected_rows($conn) > 0) {
            echo ('<script>window.location.href = "adminArea.php"</script>');
        }
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>