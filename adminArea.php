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

    <main class="admin-panel">
        <div class="container">
            <h2>Gestão de Rotas e Utilizadores</h2>

            <!-- Gestão de Rotas -->
            <section class="route-management">
                <h3>Gestão de Rotas</h3>
                <form class="route-form">
                    <input type="text" name="origin" placeholder="Origem" required>
                    <input type="text" name="destination" placeholder="Destino" required>
                    <input type="number" name="price" placeholder="Preço (€)" required>
                    <button type="submit">Criar Rota</button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>Lisboa</td>
                            <td>Porto</td>
                            <td>€15</td>
                            <td>
                                <button class="edit">Editar</button>
                                <button class="delete">Excluir</button>
                            </td>
                        </tr>
                        <!-- Mais rotas podem ser adicionadas dinamicamente -->
                    </tbody>
                </table>
            </section>

            <!-- Gestão de Utilizadores -->
            <section class="user-management">
                <h3>Gestão de Utilizadores</h3>
                <form class="search-form">
                    <input type="text" name="username" placeholder="Pesquisar utilizador" required>
                    <button type="submit">Pesquisar</button>
                </form>
                <div class="user-details">
                    <h4>Detalhes do Utilizador</h4>
                    <form>
                        <label for="name">Nome Completo</label>
                        <input type="text" id="name" value="Exemplo Nome" readonly>

                        <label for="email">Email</label>
                        <input type="email" id="email" value="exemplo@felixbus.com" readonly>

                        <label for="status">Status</label>
                        <select id="status">
                            <option value="valid">Válido</option>
                            <option value="invalid">Inválido</option>
                            <option value="pending">Pendente</option>
                        </select>

                        <button type="submit">Salvar Alterações</button>
                    </form>
                    <button class="delete-user">Excluir Utilizador</button>
                </div>
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