<?php
    include ('../basedados/basedados.h');
    include ('loginVerification.php');
    session_start();
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "UPDATE utilizador
            SET nome = '$name', email = '$email', morada = '$address'
            WHERE email = '" .$_SESSION["email"]."'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) >= 0){
        echo ('<script>window.location.href = "profile.php"</script>');
    } else {
        echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "profile.php"</script>');
    }

    mysqli_close($conn);
?>