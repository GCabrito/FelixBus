<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=" nameth=device- nameth, initial-scale=1.0">
    <title>FelixBus - Registo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">FelixBus</h1>
            <nav class="nav">
                <ul>
                    <li ><a href="index.php">Home</a></li>
                    <li>Perfil</li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="register-section">
        <div class="container">
            <h2>Crie a sua Conta</h2>
            <form class="register-form" action="register.php" method="post">
                <div class="form-group">
                    <label for="name">Nome de Utilizador</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" name="completeName" required>
                </div>
                <div class="form-group">
                    <label for="name">Morada</label>
                    <input type="text" name="address" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmar Password</label>
                    <input type="password" name="confirm-password" required>
                </div>
                <button type="submit" class="btn">Registar</button>
            </form>
            <p class="login-link">Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 FelixBus. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
       
<?php

    // //ligar à base de dados
    // $host = 'localhost';
    // $dbusername = 'root';
    // $dbpassword = '';
    // $dbname = 'FelixBus';

    // $username = $_POST["username"];
    // $completeName = $_POST["completeName"];
    // $address = $_POST["address"];
    // $email = $_POST["email"];
    // $password = $_POST["password"];
    // $confirmPassword = $_POST["confirm-password"];

    // $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // if ($password != $confirmPassword) {
    //     echo '<script> alert("Palavras-passe não coincidem");
    //           window.location.href = "register.php"</script>';
    // }
?>