<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
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

    <main>
        <section>
            <div class="container">
                <form action="searchRoute.php" method="POST">
                    <div class="pesquisa">
                        <div class="cidades">
                            <label for="partida">Partida:</label>
                            <input type="text" id="partida" name="start" placeholder="Ex: Lisboa">
                        </div>
                        <div class="cidades">
                            <label for="chegada">Chegada:</label>
                            <input type="text" id="chegada" name="end" placeholder="Ex: Porto">
                        </div>
                        
                        <div class="pesquisarBtn" style="display: flex; align-items: flex-end;">
                                <button>Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <section class="ticket-list">
            <div class="container">
                <h2>Bilhetes Disponíveis</h2>
                <div class="tickets">
                    <?php
                        // Obtém os parâmetros de pesquisa de rota da sessão
                        $start = isset($_SESSION['searchRouteStart']) ? $_SESSION['searchRouteStart'] : '';
                        $end = isset($_SESSION['searchRouteEnd']) ? $_SESSION['searchRouteEnd'] : '';

                        // Monta a query de pesquisa conforme os parâmetros recebidos
                        if (!empty($start) && !empty($end)) {
                            $sqlSearchRoute = "SELECT *
                                               FROM bilhete
                                               WHERE Partida = '$start' AND Chegada = '$end'";
                        } elseif (!empty($start)) {
                            $sqlSearchRoute = "SELECT *
                                               FROM bilhete
                                               WHERE Partida = '$start'";
                        } elseif (!empty($end)) {
                            $sqlSearchRoute = "SELECT *
                                               FROM bilhete
                                               WHERE Chegada = '$end'";
                        } 
                        
                        // Executa a pesquisa de bilhetes
                        $resultSearchRoute = mysqli_query($conn, $sqlSearchRoute);

                        // Mostra os bilhetes encontrados
                        if (mysqli_num_rows($resultSearchRoute) > 0) {
                            while ($row = mysqli_fetch_array($resultSearchRoute)) {
                                echo '<div class="ticket">
                                        <h3>'.$row['Partida'].' → '.$row['Chegada'].'</h3>
                                        <p><strong>Horário: </strong>'.$row['dataPartida'].' - '.$row['dataChegada'].'</p>
                                        <p><strong>Preço: </strong>'.$row['Preço'].' €</p>
                                        <form action="buyTicket.php" method="POST">
                                            <input type="hidden" name="idBilhete" value="' . $row['idBilhete'] . '">
                                            <input type="hidden" name="preco" value="' . $row['Preço'] . '">
                                            <input type="hidden" name="partida" value="' . $row['Partida'] . '">
                                            <input type="hidden" name="chegada" value="' . $row['Chegada'] . '">
                                            <button type="submit" class="buy-btn">Comprar Bilhete</button>
                                        </form>
                                    </div>';
                            }
                        }
                    ?>
                    <!-- Mais bilhetes podem ser listados dinamicamente -->
                </div>
            </div>
        </section>
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