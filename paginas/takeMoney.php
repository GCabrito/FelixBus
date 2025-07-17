<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    include ('loginVerification.php'); // Verifica se o utilizador está autenticado

    // Escapa o valor recebido do formulário para evitar SQL Injection
    $value = $password = mysqli_real_escape_string($conn, $_POST['amount']);

    // Atualiza o saldo do utilizador na base de dados (remove dinheiro)
    $sql = "UPDATE utilizador
            SET saldo = saldo - '$value'
            WHERE email = '" .$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    // Verifica se o saldo foi atualizado com sucesso
    if(mysqli_affected_rows($conn) == 1) {
        // Obtém o id do utilizador a partir do email da sessão
        $sql = "SELECT idUtilizador
                FROM utilizador
                WHERE email = '".$_SESSION["email"]."'";

        $result = mysqli_query($conn, $sql);

        // Se encontrou o utilizador
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $descricao = "Remoção de dinheiro"; // Descrição da transação

                // Insere a transação na tabela de transações
                $sql = "INSERT INTO transacoes (descricao, valor, idUtilizador)
                        VALUES ('$descricao', $value, ".$row['idUtilizador'].")";
    
                $result = mysqli_query($conn, $sql);
    
                // Se a transação foi registada com sucesso
                if (mysqli_affected_rows($conn) > 0) {
                    echo ('<script>alert("Dinheiro Retirado");</script>');
                    echo ('<script>window.location.href = "profile.php";</script>');
                }
            }
        }
    } else {
        // Caso ocorra algum erro na atualização do saldo
        echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "profile.php"</script>');
    }
    
    mysqli_close($conn); // Fecha a ligação à base