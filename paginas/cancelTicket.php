<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    include ('loginVerification.php'); // Verifica se o utilizador está autenticado
    

    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $idTicket = mysqli_real_escape_string($conn, $_POST['idBilhete']);
    $price = mysqli_real_escape_string($conn, $_POST['preco']);

    // Obtém o id do utilizador a partir do email da sessão
    $sql = "SELECT idUtilizador
            FROM utilizador
            WHERE email = '".$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // Remove o bilhete comprado pelo utilizador
            $sql = "DELETE FROM bilhetes_comprados
                    WHERE idBilhete = '$idTicket' AND idUtilizador = '".$row['idUtilizador']."'";

            $result = mysqli_query($conn, $sql);

            // Devolve o valor do bilhete ao saldo do utilizador
            $sql = "UPDATE utilizador
                    SET saldo = saldo + $price
                    WHERE email = '".$_SESSION["email"]."'";

            $result = mysqli_query($conn, $sql);

            // Se tudo correu bem, mostra mensagem de sucesso
            if (mysqli_affected_rows($conn) > 0) {
                echo ('<script>alert("Bilhete Cancelado");</script>');
                echo ('<script>window.location.href = "profile.php";</script>');
            }
        }
    } else {
        // Caso ocorra algum erro, mostra mensagem de erro
        echo ('<script>alert("Ocorreu um erro, tente novamente");</script>');
        echo ('<script>window.location.href = "profile.php";</script>');
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>