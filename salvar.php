<?php
include("db/conexao.php");

$sucesso = false;
$kicker = "Cadastro";
$titulo = "Nao foi possivel concluir o cadastro.";
$mensagem = "Tente novamente preenchendo os dados corretamente.";
$linkAcao = "cadastrar.php";
$textoAcao = "Voltar para o cadastro";
$linkSecundario = "index.php";
$textoSecundario = "Ir para pagina inicial";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $telefone = isset($_POST["telefone"]) ? trim($_POST["telefone"]) : "";

    if ($nome !== "" && $email !== "" && $telefone !== "") {
        $sql = "INSERT INTO clientes(nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";

        if ($conn->query($sql) === true) {
            $sucesso = true;
            $kicker = "Cadastro concluido";
            $titulo = "Cliente salvo com sucesso!";
            $mensagem = "O novo cliente foi cadastrado no sistema.";
            $linkAcao = "index.php";
            $textoAcao = "Voltar para pagina inicial";
            $linkSecundario = "clientes.php";
            $textoSecundario = "Ver lista de clientes";
        } else {
            $mensagem = "Erro ao salvar no banco de dados: " . $conn->error;
        }
    } else {
        $mensagem = "Preencha todos os campos antes de enviar o formulario.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso do Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="shortcut icon" href="./assets/favicon/favicon4.ico" type="image/x-icon">
    <link rel="stylesheet" href="./src/style/style.css">
</head>
<body class="cadastro-page">
    <main class="cadastro-wrapper">
        <section class="cadastro-card">
            <header class="cadastro-header">
                <p class="cadastro-kicker"><?php echo htmlspecialchars($kicker, ENT_QUOTES, "UTF-8"); ?></p>
                <h1><?php echo htmlspecialchars($titulo, ENT_QUOTES, "UTF-8"); ?></h1>
                <p><?php echo htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8"); ?></p>
            </header>

            <div class="cadastro-form">
                <form action="<?php echo htmlspecialchars($linkAcao, ENT_QUOTES, "UTF-8"); ?>" method="GET">
                    <button type="submit"><?php echo htmlspecialchars($textoAcao, ENT_QUOTES, "UTF-8"); ?></button>
                </form>

                <a href="<?php echo htmlspecialchars($linkSecundario, ENT_QUOTES, "UTF-8"); ?>" class="voltar-link">
                    <?php echo htmlspecialchars($textoSecundario, ENT_QUOTES, "UTF-8"); ?>
                </a>
            </div>
        </section>
    </main>
</body>
</html>
