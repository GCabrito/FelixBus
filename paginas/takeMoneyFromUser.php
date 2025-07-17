<?php
    include ('../basedados/basedados.h');
    
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif ($_SESSION['funcionario'] == false || $_SESSION['admin'] == false) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
    }
    
    session_start();

    $value = $password = mysqli_real_escape_string($conn, $_POST['amount']);

    $sql = "UPDATE utilizador
            SET saldo = saldo - '$value'
            WHERE email = '" .$_SESSION["getUserEmail"]."'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 1) {
        unset($_SESSION["getUserEmail"]);
        unset($_SESSION["getUserMoney"]);
        echo ('<script>window.location.href = "managementArea.php"</script>');
    } else {
        unset($_SESSION["getUserEmail"]);
        unset($_SESSION["getUserMoney"]);
        echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "managementArea.php"</script>');
    }

    mysqli_close($conn);
?>