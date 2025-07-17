<?php
    include ('../basedados/basedados.h');
    session_start();
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
                                echo '<button> Saldo: '  .$rowSaldo['saldo']. '€</button>';
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
                <form class="route-form" action="createRoute.php" method="post">
                    <input type="text" name="origin" placeholder="Origem" required>
                    <input type="text" name="destination" placeholder="Destino" required>
                    <input type="text" name="startTime" placeholder="Data e Hora Partida" required>
                    <input type="text" name="arriveTime" placeholder="Data e Hora Chegada" required>
                    <input type="number" step="0.01" min="0" name="price" placeholder="Preço (€)" required>
                    <input type="number" step="1" min="1" name="capacity" placeholder="Capacidade" required>
                    <button type="submit">Criar Rota</button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Data e Hora Partida</th>
                            <th>Data e Hora Chegada</th>
                            <th>Preço</th>
                            <th>Capacidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sqlRoutes = 'SELECT idBilhete, Partida, Chegada, dataPartida, dataChegada, Preço, Capacidade
                                          FROM bilhete';

                            $resultRoutes = mysqli_query($conn, $sqlRoutes);

                            while ($row = mysqli_fetch_array($resultRoutes)) {
                                echo '<tr>
                                        <td>'.$row['Partida'].'</td>
                                        <td>'.$row['Chegada'].'</td>
                                        <td>'.$row['dataPartida'].'</td>
                                        <td>'.$row['dataChegada'].'</td>
                                        <td>'.$row['Preço'].'€</td>
                                        <td>'.$row['Capacidade'].'</td>
                                        <td>
                                            <form action="deleteRoute.php" method="POST">
                                                <input type="hidden" name="idBilhete" value="' . $row['idBilhete'] . '">
                                                <button type="submit" class="delete">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </section>

            <!-- Validar Utilizadores -->
             <section class="user-validation">
                <h3>Validar Utilizadores</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $sqlUsers = "SELECT idUtilizador, nome, email, estado
                                         FROM utilizador
                                         WHERE estado = 'Pendente'";

                            $resultUsers = mysqli_query($conn, $sqlUsers);

                            while ($row = mysqli_fetch_array($resultUsers)) {
                                echo '<tr>
                                        <td>'.$row['nome'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['estado'].'</td>
                                        <td>
                                            <form action="validateUser.php" method="POST">
                                                <input type="hidden" name="idUtilizador" value="' . $row['idUtilizador'] . '">
                                                <button type="submit" class="approve-btn">Validar</button>
                                            </form>
                                            <form action="invalidateUser.php" method="POST">
                                                <input type="hidden" name="idUtilizador" value="' . $row['idUtilizador'] . '">
                                                <button type="submit" class="reject-btn">Invalidar</button>
                                            </form>
                                        </td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
             </section>

            <!-- Adicionar Utilizadores -->
            <h3>Adicionar Utilizadores</h3>
            <section class ="add-users">
                <form action="addUser.php" method="POST">
                    <label for="name">Nome</label>
                    <input type="text" name="name" value="">

                    <label for="email">Email</label>
                    <input type="email" name="email" value="">
                    
                    <label for="email">Password</label>
                    <input type="text" name="password" value="">
                    
                    <label for="email">Morada</label>
                    <input type="text" name="address" value="">
                    
                    <label for="email">Tipo de Utilizador</label>
                    <input type="text" name="type" value="">

                    <button type="submit">Criar utilizador</button>
                </form>
            </section>

            <!-- Gestão de Utilizadores -->
            <section class="user-management">
                <h3>Gestão de Utilizadores</h3>
                <form class="search-form" action="searchUser.php" method="post">
                    <input type="text" name="userEmail" placeholder="Pesquisar utilizador pelo email" required>
                    <button type="submit">Pesquisar</button>
                </form>
                <div class="user-details">
                    <h4>Detalhes do Utilizador</h4>
                    <form class="" action="updateUser.php" method="post">
                        <?php
                            if (isset($_SESSION['searchUserEmail'])) {
                                echo '<label for="name">Nome</label>
                                    <input type="text" name="name" value="'.$_SESSION['searchUserName'].'">

                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="'.$_SESSION['searchUserEmail'].'">
                                    
                                    <label for="email">Password</label>
                                    <input type="text" name="password" value="'.$_SESSION['searchUserPassword'].'">
                                    
                                    <label for="email">Morada</label>
                                    <input type="text" name="address" value="'.$_SESSION['searchUserAdress'].'">
                                    
                                    <label for="email">Tipo de Utilizador</label>
                                    <input type="text" name="type" value="'.$_SESSION['searchUserType'].'">';

                                    if ($_SESSION['searchUserState'] = 'Pendente') {
                                        echo '<label for="status">Estado</label>
                                            <select name="status">
                                                <option value="valid">Válido</option>
                                                <option value="invalid">Inválido</option>
                                                <option value="pending" selected>Pendente</option>
                                            </select>';
                                    } else if ($_SESSION['searchUserState'] = 'Válido') {
                                        echo '<label for="status">Estado</label>
                                            <select id="status">
                                                <option value="valid" selected>Válido</option>
                                                <option value="invalid">Inválido</option>
                                                <option value="pending">Pendente</option>
                                            </select>';
                                    } else if ($_SESSION['searchUserState'] = 'Inválido') {
                                        echo '<label for="status">Estado</label>
                                            <select id="status">
                                                <option value="valid">Válido</option>
                                                <option value="invalid" selected>Inválido</option>
                                                <option value="pending">Pendente</option>
                                            </select>';
                                    }
                            } else {
                                echo '<label for="name">Nome</label>
                                    <input type="text" id="name" value="" disabled>

                                    <label for="email">Email</label>
                                    <input type="email" id="email" value="" disabled>
                                    
                                    <label for="email">Password</label>
                                    <input type="email" id="email" value="" disabled>
                                    
                                    <label for="email">Morada</label>
                                    <input type="email" id="email" value="" disabled>
                                    
                                    <label for="email">Tipo de Utilizador</label>
                                    <input type="email" id="email" value="" disabled>';
                            }
                        ?>

                        <button type="submit">Salvar Alterações</button>
                    </form>
                    <?php
                        echo '<form action="deleteUser.php" method="POST">
                                <button type="submit" class="delete">Excluir</button>
                            </form>'
                    ?>
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

<?php
    mysqli_close($conn);
?>