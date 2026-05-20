<?php
include("db/conexao.php");

$sql = "SELECT id, nome, email, telefone FROM clientes ORDER BY id DESC";
$resultado = $conn->query($sql);
$clientes = [];

if ($resultado instanceof mysqli_result) {
    while ($dados = $resultado->fetch_assoc()) {
        $clientes[] = $dados;
    }
}

$totalClientes = count($clientes);
$erroConsulta = $resultado === false ? $conn->error : "";
$arquivoEdicaoExiste = file_exists(__DIR__ . "/editar.php");
$clientesHome = array_slice($clientes, 0, 5);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="shortcut icon" href="./assets/favicon/favicon4.ico" type="image/x-icon">
    <link rel="stylesheet" href="./src/style/home.css">
</head>
<body class="home-page">
    <header class="home-header">
        <div class="home-topbar">
            <div class="home-brand">
                <span class="home-brand-icon" aria-hidden="true">
                    <i class="fa-solid fa-user-group"></i>
                </span>

                <div class="home-brand-text">
                    <h1>Registro de Clientes</h1>
                    <p>Sistema de Gerenciamento de Clientes</p>
                </div>
            </div>

            <nav class="home-nav" aria-label="Navegacao principal">
                <button type="button" class="nav-item is-active" data-target="home">
                    <i class="fa-solid fa-house" aria-hidden="true"></i>
                    <span>Home</span>
                </button>

                <button type="button" class="nav-item" data-target="lista">
                    <i class="fa-solid fa-users" aria-hidden="true"></i>
                    <span>Lista de Clientes</span>
                </button>

                <a href="cadastro.php" class="nav-item nav-link">
                    <i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
                    <span>Novo Cliente</span>
                </a>

                <button type="button" class="nav-item" data-target="sobre">
                    <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                    <span>Sobre o Sistema</span>
                </button>

                <button type="button" class="nav-item nav-item-exit" data-target="sair">
                    <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                    <span>Sair</span>
                </button>
            </nav>
        </div>
    </header>

    <main class="home-main">
        <section class="home-panel is-active" data-panel="home" aria-labelledby="painel-home">
            <h2 id="painel-home">Lista de Clientes</h2>
            <p>Visualize uma previa da lista e acesse a lista completa na aba "Lista de Clientes".</p>

            <div class="home-stats">
                <article class="home-stat-card">
                    <p>Total de clientes</p>
                    <strong><?php echo $totalClientes; ?></strong>
                </article>
                <article class="home-stat-card">
                    <p>Atualizado em</p>
                    <strong><?php echo date("d/m/Y H:i"); ?></strong>
                </article>
            </div>

            <?php if ($erroConsulta !== ""): ?>
                <div class="home-feedback home-feedback-error" role="alert">
                    <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
                    <p>Erro ao consultar clientes: <?php echo htmlspecialchars($erroConsulta, ENT_QUOTES, "UTF-8"); ?></p>
                </div>
            <?php elseif ($totalClientes === 0): ?>
                <div class="home-feedback home-feedback-empty">
                    <h3 class="home-empty-title">Nenhum cliente cadastrado</h3>
                    <p>Cadastre o primeiro cliente para visualizar a lista aqui na Home.</p>
                </div>
            <?php else: ?>
                <div class="home-table-wrap">
                    <table class="home-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientesHome as $cliente): ?>
                                <tr>
                                    <td class="col-id">#<?php echo (int) $cliente["id"]; ?></td>
                                    <td><?php echo htmlspecialchars($cliente["nome"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td><?php echo htmlspecialchars($cliente["email"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td><?php echo htmlspecialchars($cliente["telefone"], ENT_QUOTES, "UTF-8"); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <div class="home-actions">
                <a class="home-cta" href="cadastro.php">Cadastrar novo cliente</a>
                <a class="home-link-ghost" href="clientes.php">Abrir pagina completa da lista</a>
            </div>
        </section>

        <section class="home-panel" data-panel="lista" aria-labelledby="painel-lista">
            <h2 id="painel-lista">Lista de Clientes</h2>
            <p>Esta aba exibe todos os clientes cadastrados no sistema.</p>

            <?php if ($erroConsulta !== ""): ?>
                <div class="home-feedback home-feedback-error" role="alert">
                    <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
                    <p>Erro ao consultar clientes: <?php echo htmlspecialchars($erroConsulta, ENT_QUOTES, "UTF-8"); ?></p>
                </div>
            <?php elseif ($totalClientes === 0): ?>
                <div class="home-feedback home-feedback-empty">
                    <h3 class="home-empty-title">Nenhum cliente cadastrado</h3>
                    <p>Cadastre um cliente para preencher esta lista.</p>
                </div>
            <?php else: ?>
                <div class="home-table-wrap">
                    <table class="home-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td class="col-id">#<?php echo (int) $cliente["id"]; ?></td>
                                    <td><?php echo htmlspecialchars($cliente["nome"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td><?php echo htmlspecialchars($cliente["email"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td><?php echo htmlspecialchars($cliente["telefone"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td>
                                        <div class="home-table-actions">
                                            <?php if ($arquivoEdicaoExiste): ?>
                                                <a href="editar.php?id=<?php echo (int) $cliente["id"]; ?>" class="home-table-action" title="Editar cliente" aria-label="Editar cliente">
                                                    <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="home-table-action home-table-action-disabled" title="Tela de edicao nao disponivel">
                                                    <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                                </span>
                                            <?php endif; ?>

                                            <a href="excluir.php?id=<?php echo (int) $cliente["id"]; ?>" class="home-table-action home-table-action-danger" title="Excluir cliente" aria-label="Excluir cliente">
                                                <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>

        <section class="home-panel" data-panel="sobre" aria-labelledby="painel-sobre">
            <h2 id="painel-sobre">Sobre o sistema</h2>
            <p> ⚙️ Este sistema centraliza o cadastro e o gerenciamento de clientes de forma simples e organizada.</p>
            <p> 📁 Desenvolvido com o objetivo de realizar o cadastro e gerenciamento de clientes de forma simples e eficiente. A aplicação permite cadastrar, consultar, editar e excluir informações dos clientes, utilizando operações CRUD completas e integração entre front-end e back-end.</p>
            <p> 🛠️ O projeto foi desenvolvido utilizando PHP, MySQL, HTML5, CSS3 e JavaScript. aplicando conceitos de validação de formulários, responsividade e manipulação de dados. Além disso, o sistema busca proporcionar uma interface intuitiva e organizada para facilitar o gerenciamento das informações cadastradas.</p>
        </section>

        <section class="home-panel" data-panel="sair" aria-labelledby="painel-sair">
            <h2 id="painel-sair">Sair do sistema</h2>
            <p>Ao sair, voce encerra esta navegacao no painel inicial.</p>
            <button type="button" class="home-logout-btn" id="logoutButton">Sair agora</button>
        </section>

        <footer class="home-footer">
            <p>&copy; 2026 Sistema de Cadastro. Todos os direitos reservados.</p>
        </footer>
    </main>

    <script src="./src/js/home.js"></script>
</body>
</html>
