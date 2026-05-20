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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="shortcut icon" href="./assets/favicon/favicon4.ico" type="image/x-icon">
    <link rel="stylesheet" href="./src/style/clientes.css">
</head>
<body class="clientes-page">
    <header class="clientes-header">
        <div class="clientes-brand">
            <span class="clientes-brand-icon" aria-hidden="true">
                <i class="fa-solid fa-users"></i>
            </span>

            <div>
                <h1>Sistema de Gerenciamento de Clientes</h1>
            </div>
        </div>

        <nav class="clientes-header-actions" aria-label="Atalhos da pagina">
            <a href="index.php" class="header-link">
                <i class="fa-solid fa-house" aria-hidden="true"></i>
                <span>Inicio</span>
            </a>

            <a href="cadastro.php" class="header-cta">
                <i class="fa-solid fa-plus" aria-hidden="true"></i>
                <span>Novo cliente</span>
            </a>
        </nav>
    </header>

    <main class="clientes-main">
        <section class="clientes-shell">
            <div class="clientes-top">
                <div>
                    <h2>Lista de Clientes</h2>
                    <p class="clientes-list-subtitle">Visualize os contatos cadastrados e acompanhe a quantidade atual de registros.</p>
                </div>

                <div class="clientes-stats">
                    <article class="stat-card">
                        <p>Total de clientes</p>
                        <strong><?php echo $totalClientes; ?></strong>
                    </article>

                    <article class="stat-card">
                        <p>Atualizado em</p>
                        <strong><?php echo date("d/m/Y H:i"); ?></strong>
                    </article>
                </div>
            </div>

            <?php if ($erroConsulta !== ""): ?>
                <div class="feedback feedback-error" role="alert">
                    <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
                    <p>Erro ao consultar os clientes: <?php echo htmlspecialchars($erroConsulta, ENT_QUOTES, "UTF-8"); ?></p>
                </div>
            <?php elseif ($totalClientes === 0): ?>
                <div class="feedback feedback-empty">
                    <i class="fa-regular fa-folder-open" aria-hidden="true"></i>
                    <h3>Nenhum cliente cadastrado</h3>
                    <p>Comece adicionando um novo cliente para preencher esta lista.</p>
                    <a href="cadastro.php" class="empty-cta">Cadastrar primeiro cliente</a>
                </div>
            <?php else: ?>
                <div class="table-wrap">
                    <table class="clientes-table">
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
                                        <div class="table-actions">
                                            <?php if ($arquivoEdicaoExiste): ?>
                                                <a href="editar.php?id=<?php echo (int) $cliente["id"]; ?>" class="table-action table-action-icon" aria-label="Editar cliente" title="Editar cliente">
                                                    <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                                </a>
                                            <?php else: ?>
                                                <button type="button" class="table-action table-action-icon table-action-disabled" aria-label="Editar cliente" aria-disabled="true" title="Tela de edicao ainda nao disponivel">
                                                    <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                                </button>
                                            <?php endif; ?>

                                            <a href="excluir.php?id=<?php echo (int) $cliente["id"]; ?>" class="table-action table-action-icon table-action-danger" aria-label="Excluir cliente" title="Excluir cliente">
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
    </main>
</body>
</html>
