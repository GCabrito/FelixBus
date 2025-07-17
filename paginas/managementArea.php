<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados

    // Verifica se o utilizador está autenticado
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    // Verifica se o utilizador tem permissões de admin ou funcionário
    } elseif (empty($_SESSION['admin']) && empty($_SESSION['funcionario'])) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FelixBus</title>
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

    <main class="user-management">
        <div class="container">
            <h2>Gestão de Utilizadores</h2>
            
            <!-- Pesquisa de Utilizadores -->
            <section class="search-section">
                <h3>Pesquisar Utilizador</h3>
                <form class="search-form" action="getUser.php" method="POST">
                    <input type="text" name="email" placeholder="Digite o nome ou email do utilizador" required>
                    <button type="submit">Pesquisar</button>
                </form>
            </section>

            <!-- Resultados da Pesquisa -->
            <section class="results-section">
                <h3>Detalhes do Utilizador</h3>
                <div class="user-details">

                    <div class="wallet-management">
                        <h4>Carteira</h4>
                        <?php
                            // Mostra email e saldo do utilizador pesquisado (ou campos vazios)
                            $_SESSION['getUserEmail'] = isset($_SESSION['getUserEmail']) ? $_SESSION['getUserEmail'] : '';
                            $_SESSION['getUserMoney'] = isset($_SESSION['getUserMoney']) ? $_SESSION['getUserMoney'] : '';
                            if (isset($_SESSION['getUserEmail'])) {
                                echo '<p>email do Utilizador: '.$_SESSION['getUserEmail'].'</p>
                                      <p>Saldo Atual: <strong>'.$_SESSION['getUserMoney'].'€</strong></p>';
                            } else {
                                echo '<p>email do Utilizador:</p>
                                      <p>Saldo Atual:</p>';
                            }
                        ?>
                        <form action="addMoneyToUser.php" method="POST">
                            <label for="amount">Valor (€)</label>
                            <input type="number" id="amount" name="amount" step="0.01" placeholder="Digite o valor">
                            
                            <button type="submit" class="add">Adicionar</button>
                        </form>
                        <form action="takeMoneyFromUser.php" method="POST">
                            <label for="amount">Valor (€)</label>
                            <input type="number" id="amount" name="amount" step="0.01" placeholder="Digite o valor">
                            
                            <button type="submit" class="remove">Remover</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Gestão de Bilhetes -->
            <section class="ticket-management">
                <h3>Bilhetes do Utilizador</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Data</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Mostra os bilhetes do utilizador pesquisado
                            $sql = "SELECT b.Partida, b.Chegada, b.dataPartida, b.Preço, b.idBilhete
                                    FROM bilhete b INNER JOIN bilhetes_comprados bc
                                        ON b.idBilhete = bc.idBilhete
                                    INNER JOIN utilizador u
                                        ON bc.idUtilizador = u.idUtilizador
                                    WHERE u.email = '" .$_SESSION['getUserEmail']."'";

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
                                                    <button type="submit" class="delete-ticket">Cancelar</button>
                                                </form>
                                            </td>
                                        </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </section>
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