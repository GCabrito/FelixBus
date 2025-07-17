<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    
    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);

    // Verifica se as passwords coincidem
    if ($password != $confirmPassword) {
        echo '<script> alert("Palavras-passe não coincidem");
              window.location.href = "register.html"</script>';
    } else {
        // Encripta a nova password usando SHA-256
        $encryptedPass = hash('sha256', $password);

        // Atualiza a password do utilizador na base de dados
        $sql = "UPDATE utilizador
                SET pass = '$encryptedPass'
                WHERE email = '$email'";
    
        $result = mysqli_query($conn, $sql);

        // Verifica se a password foi alterada com sucesso
        if (mysqli_affected_rows ($conn) == 1)
            echo ('<script> alert("Password trocada");
              window.location.href = "login.html"</script>');
        else
            // Caso ocorra algum erro, mostra mensagem de erro
            echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "changePassword.html"</script>');
    }

    mysqli_close($conn); // Fecha a ligação à base
?>