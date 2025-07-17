<?php
    session_start();
    include ('../basedados/basedados.h');
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);

    if ($password != $confirmPassword) {
        echo '<script> alert("Palavras-passe não coincidem");
              window.location.href = "register.html"</script>';
    } else {
        $encryptedPass = hash('sha256', $password);

        $sql = "UPDATE utilizador
                SET pass = '$encryptedPass'
                WHERE email = '$email'";
    
        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows ($conn) == 1)
            echo ('<script> alert("Password trocada");
              window.location.href = "login.html"</script>');
        else
            echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "changePassword.html"</script>');
    }

    mysqli_close($conn);
?>