<?php
    session_start();
    include ('../basedados/basedados.h');
    include ('loginVerification.php');
    

    $idTicket = mysqli_real_escape_string($conn, $_POST['idBilhete']);
    $price = mysqli_real_escape_string($conn, $_POST['preco']);

    $sql = "SELECT idUtilizador
            FROM utilizador
            WHERE email = '".$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $sql = "DELETE FROM bilhetes_comprados
                    WHERE idBilhete = '$idTicket' AND idUtilizador = '".$row['idUtilizador']."'";

            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE utilizador
                    SET saldo = saldo + $price
                    WHERE email = '".$_SESSION["email"]."'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn) > 0) {
                echo ('<script>alert("Bilhete Cancelado");</script>');
                echo ('<script>window.location.href = "profile.php";</script>');
            }
        }
    } else {
        echo ('<script>alert("Ocorreu um erro, tente novamente");</script>');
        echo ('<script>window.location.href = "profile.php";</script>');
    }

    mysqli_close($conn);
?>