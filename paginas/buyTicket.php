<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    include ('loginVerification.php'); // Verifica se o utilizador está autenticado

    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $idTicket = mysqli_real_escape_string($conn, $_POST['idBilhete']);
    $price = mysqli_real_escape_string($conn, $_POST['preco']);
    $start = mysqli_real_escape_string($conn, $_POST['partida']);
    $end = mysqli_real_escape_string($conn, $_POST['chegada']);

    // Verifica o saldo do utilizador
    $sql = "SELECT saldo
            FROM utilizador
            WHERE email = '".$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result)) {
            // Se o saldo for insuficiente, mostra alerta e redireciona
            if ($price > $row['saldo']) {
                echo ('<script>alert("Não tem dinheiro suficiente."); 
                        window.location.href = "index.php";</script>');
                exit;
            }
        }
    }

    // Obtém o id do utilizador
    $sql = "SELECT idUtilizador
            FROM utilizador
            WHERE email = '".$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // Regista o bilhete comprado
            $sql = "INSERT INTO bilhetes_comprados
                    VALUES ('$idTicket', '".$row['idUtilizador']."')";

            $result = mysqli_query($conn, $sql);

            // Regista a transação na tabela de transações
            $descricao = "Bilhete $start -> $end";
            $sql = "INSERT INTO transacoes (descricao, valor, idUtilizador)
                    VALUES ('$descricao', $price, ".$row['idUtilizador'].")";

            $result = mysqli_query($conn, $sql);

            // Atualiza o saldo do utilizador
            $sql = "UPDATE utilizador
                    SET saldo = saldo - $price
                    WHERE email = '".$_SESSION["email"]."'";

            $result = mysqli_query($conn, $sql);

            // Se tudo correu bem, mostra mensagem de sucesso
            if (mysqli_affected_rows($conn) > 0) {
                echo ('<script>alert("Bilhete Comprado");</script>');
                echo ('<script>window.location.href = "index.php";</script>');
            }
        }
    } else {
        // Caso ocorra algum erro, mostra mensagem de erro
        echo ('<script>alert("Ocorreu um erro, tente novamente");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>