<?php
    include ('../basedados/basedados.h');
    
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif ($_SESSION['admin'] == false) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
    }
    
    session_start();
    
    if (isset($_POST['idUtilizador'])) {
        $idUtilizador = mysqli_real_escape_string($conn, $_POST['idUtilizador']);

        $sql = "UPDATE utilizador
                SET estado = 'Inválido'
                WHERE idUtilizador = '$idUtilizador'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            echo ('<script>window.location.href = "adminArea.php"</script>');
        }
    }

    mysqli_close($conn);
?>