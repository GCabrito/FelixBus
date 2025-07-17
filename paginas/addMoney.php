<?php
    include ('../basedados/basedados.h');
    include ('loginVerification.php');
    session_start();

    $value = $password = mysqli_real_escape_string($conn, $_POST['amount']);
    $sql = "UPDATE utilizador
            SET saldo = saldo + '$value'
            WHERE email = '" .$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 1) {

        $sql = "SELECT idUtilizador
            FROM utilizador
            WHERE email = '".$_SESSION["email"]."'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $descricao = "Adição à carteira";
                $sql = "INSERT INTO transacoes (descricao, valor, idUtilizador)
                        VALUES ('$descricao', $value, ".$row['idUtilizador'].")";
    
                $result = mysqli_query($conn, $sql);
    
                if (mysqli_affected_rows($conn) > 0) {
                    echo ('<script>alert("Dinheiro Adicionado");</script>');
                    echo ('<script>window.location.href = "profile.php";</script>');
                }
            }
        }
    } else {
        echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "profile.php"</script>');
    }
    mysqli_close($conn);
?>