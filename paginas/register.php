<?php
    include ('../basedados/basedados.h');
    session_start();
    
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    if ($password != $confirmPassword) {
        echo '<script> alert("Palavras-passe não coincidem");
              window.location.href = "register.html"</script>';
    } else {
        $encryptedPass = hash('sha256', $password);

        $sql = "INSERT INTO utilizador (nome, pass, email, morada)
                VALUES ('$name', '$encryptedPass', '$email', '$address')";
    
        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows ($conn) == 1)
            echo ('<script> alert("Registado com sucesso! Pode fazer login assim que for validado");
              window.location.href = "login.html"</script>');
        else
            echo ('<script> alert("Ocorreu um erro, tente novamente");
              window.location.href = "register.html"</script>');
    }

    mysqli_close($conn);
?>