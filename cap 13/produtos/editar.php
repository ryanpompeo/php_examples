<?php
    require "../autenticacao.php"; // Verifica se o usuário está autenticado
    require "../permissao.php"; // Verifica se o usuário tem permissão para acessar a página

    require "../config.php";

    // Recebe o ID enviado pela URL
    $id = $_GET['id'];

    // Busca produto
    $sql = "SELECT * FROM produtos WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Transforma em array associativo
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Atualização
    $erro = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nome = trim($_POST['nome']);
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];

        if (empty($nome)) {
            $erro .= "Nome obrigatório<br>";
        }

        if (empty($preco) || $preco <= 0) {
            $erro .= "Preço inválido<br>";
        }

        if (empty($quantidade) || $quantidade <= 0) {
            $erro .= "Quantidade inválida<br>";
        }

        if ($erro == "") {
            $sql = "UPDATE produtos
                    SET nome = :nome,
                        preco = :preco,
                        quantidade = :quantidade
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            header("Location: listar.php?editado=1");
            exit;
        }else {
    // deu erro: guarda o que foi digitado
    $produto['nome'] = $nome;
    $produto['preco'] = $preco;
    $produto['quantidade'] = $quantidade;  
}
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>

<body>

    <h1>✏️ Editar Produto</h1>
    <hr>

    <?php if (!empty($erro)): ?>
    <div style="color: red;"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">
        Nome:<br>
        <input type="text" name="nome" placeholder="Nome" value="<?= $produto['nome'] ?>">
        <br><br>

        Preço:<br>
        <input type="number" step="0.01" name="preco" placeholder="Preço" value="<?= $produto['preco'] ?>">
        <br><br>

        Quantidade:<br>
        <input type="number" name="quantidade" placeholder="Quantidade" value="<?= $produto['quantidade'] ?>">
        <br><br>

        <button type="submit">
            ✔ Salvar Alterações
        </button>

        <button type="button" onclick="window.location.href='listar.php'">
            ❌Cancelar
        </button>

    </form>

</body>

</html>