<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=" nameth=device- nameth, initial-scale=1.0">
    <title>FelixBus - Login</title>
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

    <section class="login-section">
        <div class="container">
            <h2>Faça login com a sua Conta</h2>
            <form class="register-form" action="register.php" method="post">
                <div class="form-group">
                    <label for="name">Nome de Utilizador</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p class="login-link">Ainda não tem uma conta? <a href="register.php">Crie agora uma</a></p>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 FelixBus. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>