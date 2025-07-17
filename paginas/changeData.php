<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    include ('loginVerification.php'); // Verifica se o utilizador está autenticado
    
    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Atualiza os dados do utilizador na base de dados
    $sql = "UPDATE utilizador
            SET nome = '$name', email = '$email', morada = '$address'
            WHERE email = '" .$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    // Verifica se os dados foram atualizados com sucesso
    if(mysqli_affected_rows($conn) >= 0){
        echo ('<script>window.location.href = "profile.php"</script>');
    } else {
        // Caso ocorra algum erro, mostra mensagem de erro
        echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "profile.php"</script>');
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>