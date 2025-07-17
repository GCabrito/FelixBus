<?php
    session_start();
    include ('../basedados/basedados.h');
    
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif (empty($_SESSION['admin']) && empty($_SESSION['funcionario'])) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }

    session_start();
    
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $sql = "SELECT *
            FROM utilizador
            WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 1) {
        while($row = mysqli_fetch_array($result)){
            $_SESSION['getUserEmail'] = $row['email'];
            $_SESSION['getUserMoney'] = $row['saldo'];
        }
        echo ('<script>window.location.href = "managementArea.php"</script>');
    } else {
        unset($_SESSION['getUserEmail']);
        echo ('<script>alert("Não foi encontrado nenhum utilizador.");</script>');
        echo ('<script>window.location.href = "managementArea.php";</script>');
    }
        
    mysqli_close($conn);
?>