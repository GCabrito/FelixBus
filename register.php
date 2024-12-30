<?php
    session_start();

    //ligar à base de dados
    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'FelixBus';

    $username = $_POST["username"];
    $completeName = $_POST["completeName"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($password != $confirmPassword) {
        echo '<script> alert("Palavras-passe não coincidem");
              window.location.href = "register.html"</script>';
    }
?>