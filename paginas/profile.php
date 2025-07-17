<?php
    //session_start(); // (Comentado porque loginVerification já inicia a sessão)
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    include ('../paginas/loginVerification.php'); // Verifica se o utilizador está autenticado
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
                        // Mostra botões de navegação conforme o tipo de utilizador
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
                        
                        // Se o utilizador estiver autenticado, mostra nome, saldo e botão de logout
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
                                echo '<button> Saldo: '  .$rowSaldo['saldo']. '€</button>';
                            }

                            echo '<form action="logout.php" method=”GET”>
                                    <button> Terminar Sessão</button>
                                </form>';
                        } else {
                            // Se não estiver autenticado, mostra botão de login
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
            <h3>Meu Perfil</h3>
            <div class="profile-sections">
                <!-- Editar dados pessoais -->
                <section class="personal-info">
                    <h3>Editar Dados Pessoais</h3>
                    <?php
                        // Mostra formulário para editar dados pessoais do utilizador
                        if (isset($_SESSION["email"])) {
                            $sqlUserData = "SELECT *
                                            FROM utilizador
                                            WHERE email = '" .$_SESSION["email"]."'";

                            $resultUserData = mysqli_query($conn, $sqlUserData);

                            while ($rowUserData = mysqli_fetch_array($resultUserData)) {
                                echo '<form action="changeData.php" method="POST">
                                        <div class="form-group">
                                            <label for="username">Nome:</label>
                                            <input type="text" id="name" name="name" value="'.$rowUserData['nome'].'" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" value="'.$rowUserData['email'].'" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Morada:</label>
                                            <input type="text" id="address" name="address" value="'.$rowUserData['morada'].'" required>
                                        </div>
                                        <div style="text-align: end;">
                                            <button type="submit" class="btn">Guardar Alterações</button>
                                        </div>
                                    </form>';
                            }
                        }
                    ?>
                </section>

                <!-- Carteira -->
                <section class="wallet">
                    <h3>Minha Carteira</h3>
                    <?php
                        // Mostra saldo disponível na carteira do utilizador
                        if (isset($_SESSION["email"])) {
                            $sqlUserMoney = "SELECT saldo
                                            FROM utilizador
                                            WHERE email = '" .$_SESSION["email"]."'";

                            $resultUserMoney = mysqli_query($conn, $sqlUserMoney);

                            while ($rowUserMoney = mysqli_fetch_array($resultUserMoney)) {
                                echo '<p>Saldo Disponível: <span class="wallet-balance">'.$rowUserMoney['saldo'].' €</span></p>';
                            }
                        }
                    ?>
                    <form action="addMoney.php" method="POST" class="wallet-actions">
                        <div class="form-group">
                            <label for="wallet-amount">Valor (€):</label>
                            <input type="number" id="wallet-amount" name="amount" step="0.01" placeholder="Insira o valor" required>
                        </div>
                        <div class="wallet-buttons">
                            <button type="submit" name="action" value="add" class="btn">Adicionar</button>
                        </div>
                    </form>
                    <form action="takeMoney.php" method="POST" class="wallet-actions">
                        <div class="form-group">
                            <label for="wallet-amount">Valor (€):</label>
                            <input type="number" id="wallet-amount" name="amount" step="0.01" placeholder="Insira o valor" required>
                        </div>
                        <div class="wallet-buttons">
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
                                <th>Partida</th>
                                <th>Destino</th>
                                <th>Data</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Mostra os bilhetes comprados pelo utilizador
                                $sql = "SELECT b.Partida, b.Chegada, b.dataPartida, b.Preço, b.idBilhete
                                        FROM bilhete b INNER JOIN bilhetes_comprados bc
                                            ON b.idBilhete = bc.idBilhete
                                        INNER JOIN utilizador u
                                            ON bc.idUtilizador = u.idUtilizador
                                        WHERE u.email = '" .$_SESSION["email"]."'";

                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<tr>
                                                <td>'.$row['Partida'].'</td>
                                                <td>'.$row['Chegada'].'</td>
                                                <td>'.$row['dataPartida'].'</td>
                                                <td>'.$row['Preço'].'€</td>
                                                <td>
                                                    <form action="cancelTicket.php" method="POST">
                                                        <input type="hidden" name="idBilhete" value="' . $row['idBilhete'] . '">
                                                        <input type="hidden" name="preco" value="' . $row['Preço'] . '">
                                                        <button type="submit" class="btn-cancel">Cancelar</button>
                                                    </form>
                                                </td>
                                            </tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </section>

                <section class="transactions">
                    <h3>Minhas Transações</h3>
                    <table class="transactions-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor (€)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Mostra as transações do utilizador
                                $sql = "SELECT t.dataTransacao, t.descricao, t.valor
                                        FROM transacoes t INNER JOIN utilizador u
                                        on t.idUtilizador = u.idUtilizador
                                        WHERE u.email = '" .$_SESSION["email"]."'
                                        ORDER BY t.dataTransacao DESC";

                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<tr>
                                                <td>'.$row['dataTransacao'].'</td>
                                                <td>'.$row['descricao'].'</td>
                                                <td>'.$row['valor'].'€</td>
                                            </tr>';
                                    }
                                }
                            ?>
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

<?php
    mysqli_close($conn); // Fecha a ligação à base de dados
?>