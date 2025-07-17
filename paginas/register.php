<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    
    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm-password']);

    // Verifica se as passwords coincidem
    if ($password != $confirmPassword) {
        echo '<script> alert("Palavras-passe não coincidem");
              window.location.href = "register.html"</script>';
    } else {
        // Encripta a password usando SHA-256
        $encryptedPass = hash('sha256', $password);

        // Insere o novo utilizador na base de dados
        $sql = "INSERT INTO utilizador (nome, pass, email, morada)
                VALUES ('$name', '$encryptedPass', '$email', '$address')";
    
        $result = mysqli_query($conn, $sql);

        // Verifica se o utilizador foi registado com sucesso
        if (mysqli_affected_rows ($conn) == 1)
            echo ('<script> alert("Registado com sucesso! Pode fazer login assim que for validado");
              window.location.href = "login.html"</script>');
        else
            // Caso ocorra algum erro, mostra mensagem de erro
            echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "register.html"</script>');
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>