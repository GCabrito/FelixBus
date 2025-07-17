<?php
    session_start();
    include ('../basedados/basedados.h');
    
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif ($_SESSION['admin'] == false) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
    }
    
    session_start();
    
    $userEmail = mysqli_real_escape_string($conn, $_POST["userEmail"]);

    $sql = "SELECT u.idUtilizador, u.nome, u.email, u.pass, u.morada, t.Nome, u.estado, u.saldo
            FROM utilizador u join tipoutilizador t
            ON u.tipoUtilizador = t.idTipoUtilizador
            WHERE email = '$userEmail'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 1) {
        while($row = mysqli_fetch_array($result)){
            $_SESSION['searchUserId'] = $row['idUtilizador'];
            $_SESSION['searchUserName'] = $row['nome'];
            $_SESSION['searchUserEmail'] = $row['email'];
            $_SESSION['searchUserPassword'] = $row['pass'];
            $_SESSION['searchUserAdress'] = $row['morada'];
            $_SESSION['searchUserType'] = $row['Nome'];
            $_SESSION['searchUserMoney'] = $row['saldo'];
            $_SESSION['searchUserState'] = $row['estado'];
        }
        echo ('<script>window.location.href = "adminArea.php"</script>');
    } else {
        unset($_SESSION['searchUserEmail']);
        echo ('<script>alert("Não foi encontrado nenhum utilizador.");</script>');
        echo ('<script>window.location.href = "adminArea.php";</script>');
    }
        
    mysqli_close($conn);
?>