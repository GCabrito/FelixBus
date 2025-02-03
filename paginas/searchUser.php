<?php
    include ('../basedados/basedados.h');
    session_start();
    
    $userEmail = $_POST["userEmail"];

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