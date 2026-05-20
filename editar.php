<?php

include("db/conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id = $id";

$resultado = $conn->query($sql);

$dados = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="shortcut icon" href="./assets/favicon/favicon4.ico" type="image/x-icon">
    <link rel="stylesheet" href="./src/style/style.css">
</head>
<body class="cadastro-page">

    <main class="cadastro-wrapper">
        <section class="cadastro-card">
            <header class="cadastro-header">
                <p class="cadastro-kicker">Atualização de cadastro</p>
                <h1>Edite o Cadastro</h1>
                <p>Atualize os dados do cliente selecionado.</p>
            </header>

            <form action="atualizar.php" method="POST" class="cadastro-form">

                <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

                <label for="nome">Nome</label>
                <div class="field-with-icon">
                    <i class="fa-regular fa-user" aria-hidden="true"></i>
                    <input type="text" id="nome" name="nome" class="input-with-icon" value="<?php echo htmlspecialchars($dados['nome'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <label for="email">Email</label>
                <div class="field-with-icon">
                    <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                    <input type="email" id="email" name="email" class="input-with-icon" value="<?php echo htmlspecialchars($dados['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <label for="telefone">Telefone</label>
                <div class="field-with-icon">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    <input type="text" id="telefone" name="telefone" class="input-with-icon" value="<?php echo htmlspecialchars($dados['telefone'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <button type="submit">Atualizar cliente</button>

                <a href="clientes.php" class="voltar-link">Voltar para lista</a>
            </form>
        </section>
    </main>

</body>
</html>
