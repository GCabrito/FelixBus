<?php
    session_start();

    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'FelixBus';

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FelixBus - Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">FelixBus</h1>
            <nav class="nav">
                <ul>
                    <form action="index.php" method="GET">
                        <button>Home</button>
                    </form>
                
                    <?php 
                        if (isset($_SESSION['admin']) or isset($_SESSION['funcionario'])) {
                            echo'<form action="managementArea.php" method="GET">
                                    <button>Área de Gestão</button>
                                 </form>';
                        }                
                    
                        if (isset($_SESSION['admin'])) {
                            echo'<form action="adminArea.php" method="GET">
                                    <button>Área de Administração</button>
                                 </form>';
                        }
                        
                        if (isset($_SESSION["email"])) {
                            $sqlNome = "SELECT nome
                                        FROM utilizador
                                        WHERE email = '" .$_SESSION["email"]."'";

                            $resultNome = mysqli_query($conn, $sqlNome);

                            while ($rowNome = mysqli_fetch_assoc($resultNome)) {
                                echo '<form action="profile.php" method=”GET”>
                                        <button><strong>' .$rowNome['nome']. '</strong></button>
                                    </form>';
                            }

                            $sqlSaldo = "SELECT saldo
                                        FROM utilizador
                                        WHERE email = '" .$_SESSION["email"]."'";
                                        
                            $resultSaldo = mysqli_query($conn, $sqlSaldo);

                            while ($rowSaldo = mysqli_fetch_assoc($resultSaldo)) {
                                echo '<form action="profile.php" method=”GET”>
                                        <button> Saldo: '  .$rowSaldo['saldo']. '€</button>
                                    </form>';
                            }

                            echo '<form action="logout.php" method=”GET”>
                                    <button> Terminar Sessão</button>
                                </form>';
                        } else {
                            echo '<form action="login.html" method=”GET”>
                                    <button> Iniciar Sessão </button>
                                </form>';
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="profile">
        <div class="container">
            <h2>Meu Perfil</h2>
            <div class="profile-sections">
                <!-- Editar dados pessoais -->
                <section class="personal-info">
                    <h3>Editar Dados Pessoais</h3>
                    <form action="update_profile.php" method="POST">
                        <div class="form-group">
                            <label for="username">Nome de Utilizador:</label>
                            <input type="text" id="username" name="username" placeholder="exemplo123" required>
                        </div>
                        <div class="form-group">
                            <label for="completeName">Nome Completo:</label>
                            <input type="text" id="completeName" name="completeName" placeholder="exemplo" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="exemplo@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Morada:</label>
                            <input type="text" id="address" name="address" placeholder="Rua do Exemplo" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Nova Palavra-passe:</label>
                            <input type="password" id="password" name="password" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirmar Nova Palavra-passe:</label>
                            <input type="password" id="password" name="password" placeholder="">
                        </div>
                        <div style="text-align: end;">
                            <button type="submit" class="btn">Guardar Alterações</button>
                        </div>
                    </form>
                </section>

                <!-- Carteira -->
                <section class="wallet">
                    <h3>Minha Carteira</h3>
                    <p>Saldo Disponível: <span class="wallet-balance">€100.00</span></p>
                    <form action="update_wallet.php" method="POST" class="wallet-actions">
                        <div class="form-group">
                            <label for="wallet-amount">Valor (€):</label>
                            <input type="number" id="wallet-amount" name="amount" step="0.01" placeholder="Insira o valor" required>
                        </div>
                        <div class="wallet-buttons">
                            <button type="submit" name="action" value="add" class="btn">Adicionar</button>
                            <button type="submit" name="action" value="withdraw" class="btn">Retirar</button>
                        </div>
                    </form>
                </section>

                <!-- Gerir bilhetes comprados -->
                <section class="tickets">
                    <h3>Bilhetes Comprados</h3>
                    <table class="tickets-table">
                        <thead>
                            <tr>
                                <th>Destino</th>
                                <th>Data</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lisboa</td>
                                <td>2024-01-15</td>
                                <td>€15</td>
                                <td><button class="btn-cancel">Cancelar</button></td>
                            </tr>
                            <tr>
                                <td>Porto</td>
                                <td>2024-02-10</td>
                                <td>€20</td>
                                <td><button class="btn-cancel">Cancelar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 FelixBus. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>