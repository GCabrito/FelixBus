<?php
    include ('../basedados/basedados.h');
    include ('loginVerification.php');
    session_start();

    $idTicket = mysqli_real_escape_string($conn, $_POST['idBilhete']);
    $price = mysqli_real_escape_string($conn, $_POST['preco']);
    $start = mysqli_real_escape_string($conn, $_POST['partida']);
    $end = mysqli_real_escape_string($conn, $_POST['chegada']);

    $sql = "SELECT saldo
            FROM utilizador
            WHERE email = '".$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result)) {
            if ($price > $row['saldo']) {
                echo ('<script>alert("Não tem dinheiro suficiente."); 
                        window.location.href = "index.php";</script>');
                exit;
            }
        }
    }

    $sql = "SELECT idUtilizador
            FROM utilizador
            WHERE email = '".$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $sql = "INSERT INTO bilhetes_comprados
                    VALUES ('$idTicket', '".$row['idUtilizador']."')";

            $result = mysqli_query($conn, $sql);

            $descricao = "Bilhete $start -> $end";
            $sql = "INSERT INTO transacoes (descricao, valor, idUtilizador)
                    VALUES ('$descricao', $price, ".$row['idUtilizador'].")";

            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE utilizador
                    SET saldo = saldo - $price
                    WHERE email = '".$_SESSION["email"]."'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn) > 0) {
                echo ('<script>alert("Bilhete Comprado");</script>');
                echo ('<script>window.location.href = "index.php";</script>');
            }
        }
    } else {
        echo ('<script>alert("Ocorreu um erro, tente novamente");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }

    mysqli_close($conn);
?>