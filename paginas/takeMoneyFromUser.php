<?php
    include ('../basedados/basedados.h');
    include ('loginVerification.php');
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