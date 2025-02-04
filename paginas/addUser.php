<?php
    include ('../basedados/basedados.h');
    session_start();

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $encryptedPass = hash('sha256', $password);

    $sql = "INSERT INTO utilizador (nome, pass, email, morada)
            VALUES('$name', '$encryptedPass', '$email', '$address')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        echo ('<script>alert("Utilizador adicionado");</script>');
        echo ('<script>window.location.href = "adminArea.php";</script>');
    } else {
        echo ('<script>alert("Ocorreu um erro");</script>');
        echo ('<script>window.location.href = "adminArea.php";</script>');
    }
?>