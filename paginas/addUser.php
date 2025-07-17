<?php
    session_start(); // Inicia a sessão

    // Inclui o ficheiro de ligação à base de dados
    include ('../basedados/basedados.h');
    
    // Verifica se o utilizador está autenticado
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    // Verifica se o utilizador tem permissões de admin
    } elseif ($_SESSION['admin'] == false) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.html";</script>');
    }

    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Encripta a password usando SHA-256
    $encryptedPass = hash('sha256', $password);

    // Insere o novo utilizador na base de dados
    $sql = "INSERT INTO utilizador (nome, pass, email, morada)
            VALUES('$name', '$encryptedPass', '$email', '$address')";

    $result = mysqli_query($conn, $sql);

    // Verifica se o utilizador foi adicionado com sucesso
    if (mysqli_affected_rows($conn) > 0) {
        echo ('<script>alert("Utilizador adicionado");</script>');
        echo ('<script>window.location.href = "adminArea.php";</script>');
    } else {
        echo ('<script>alert("Ocorreu um erro");</script>');
        echo ('<script>window.location.href = "adminArea.php";</script>');
    }
?>