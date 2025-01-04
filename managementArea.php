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
                        if (isset($_SESSION['admin']) or isset($_SESSION['funcionario'])) {
                            echo'<form action="adminArea.php" method="GET">
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

    <main class="user-management">
        <div class="container">
            <h2>Gestão de Utilizadores</h2>
            
            <!-- Pesquisa de Utilizadores -->
            <section class="search-section">
                <h3>Pesquisar Utilizador</h3>
                <form class="search-form">
                    <input type="text" name="username" placeholder="Digite o nome ou email do utilizador" required>
                    <button type="submit">Pesquisar</button>
                </form>
            </section>

            <!-- Resultados da Pesquisa -->
            <section class="results-section">
                <h3>Detalhes do Utilizador</h3>
                <div class="user-details">
                    <div class="persInfo-management">
                        <h4>Dados Pessoais</h4>
                        <form>
                            <label for="name">Nome Completo</label>
                            <input type="text" id="name" value="Exemplo Nome" readonly>
                            
                            <label for="email">Email</label>
                            <input type="email" id="email" value="exemplo@felixbus.com" readonly>
                            
                            <label for="address">Endereço</label>
                            <input type="text" id="address" value="Rua Exemplo, 123" readonly>
                            
                            <button type="button">Editar Dados</button>
                        </form>
                    </div>

                    <div class="wallet-management">
                        <h4>Carteira</h4>
                        <p>Saldo Atual: <strong>€50.00</strong></p>
                        <form>
                            <label for="amount">Valor (€)</label>
                            <input type="number" id="amount" placeholder="Digite o valor">
                            
                            <button type="submit" class="add">Adicionar</button>
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
                            <th>ID do Bilhete</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12345</td>
                            <td>Lisboa</td>
                            <td>Porto</td>
                            <td>2024-01-15</td>
                            <td>
                                <button class="edit-ticket">Editar</button>
                                <button class="delete-ticket">Excluir</button>
                            </td>
                        </tr>
                        <!-- Mais bilhetes podem ser adicionados dinamicamente -->
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