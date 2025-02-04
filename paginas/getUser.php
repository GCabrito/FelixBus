<?php
    include ('../basedados/basedados.h');
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