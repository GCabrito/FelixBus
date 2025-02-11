<?php
    include ('../basedados/basedados.h');
    include ('loginVerification.php');
    session_start();
    
    if (isset($_POST['idUtilizador'])) {
        $idUtilizador = mysqli_real_escape_string($conn, $_POST['idUtilizador']);

        $sql = "UPDATE utilizador
                SET estado = 'Válido'
                WHERE idUtilizador = '$idUtilizador'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            echo ('<script>window.location.href = "adminArea.php"</script>');
        }
    }

    mysqli_close($conn);
?>