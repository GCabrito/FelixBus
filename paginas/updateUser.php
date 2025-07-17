<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    
    // Verifica se o utilizador está autenticado
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif ($_SESSION['admin'] == false) {
        // Verifica se o utilizador tem permissões de admin
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }
    
    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $money = mysqli_real_escape_string($conn, $_POST['money']);
    $searchEmail = mysqli_real_escape_string($conn, $_SESSION['searchUserEmail']);

    // Atualiza os dados do utilizador na base de dados
    $sql = "UPDATE utilizador
            SET nome = '$name', pass = '$password', email = '$email', morada = '$address'
            WHERE email ='$searchEmail'";

    $result = mysqli_query($conn, $sql);

    // Se a atualização foi bem sucedida, limpa sessão e redireciona
    if(mysqli_affected_rows($conn) >= 0){
        unset($_SESSION['searchUserEmail']);
        echo ('<script>window.location.href = "adminArea.php"</script>');
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>