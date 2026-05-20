<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="./src/style/style.css">
    <link rel="shortcut icon" href="./assets/favicon/favicon4.ico" type="image/x-icon">
    <script src="./src/js/script.js"></script>
</head>
<body class="cadastro-page">

    <main class="cadastro-wrapper">
        <section class="cadastro-card">
            <header class="cadastro-header">
                <p class="cadastro-kicker">Novo cliente</p>
                <h1>Faça seu Cadastro</h1>
                <p>Preencha os dados abaixo para salvar um novo cliente no sistema.</p>
            </header>

            <form action="salvar.php" method="POST" onsubmit="return validarFormulario()" class="cadastro-form">
                <label for="nome">Nome</label>
                <div class="field-with-icon">
                    <i class="fa-regular fa-user" aria-hidden="true"></i>
                    <input type="text" id="nome" name="nome" class="input-with-icon" placeholder="Ex: Maria Silva" required>
                </div>

                <label for="email">Email</label>
                <div class="field-with-icon">
                    <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                    <input type="email" id="email" name="email" class="input-with-icon" placeholder="maria@email.com" required>
                </div>

                <label for="telefone">Telefone</label>
                <div class="field-with-icon">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    <input type="text" id="telefone" name="telefone" class="input-with-icon" placeholder="(11) 99999-9999" required>
                </div>

                    <button type="submit">Salvar cliente</button>

                <a href="clientes.php" class="voltar-link">Voltar para lista</a>
            </form>
        </section>
    </main>

</body>
</html>
