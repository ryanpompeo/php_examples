<?php
// Criar ou atualizar cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $valor = $_POST['valor'] ?? '';

    if ($nome !== '') {
        setcookie($nome, $valor, time() + 3600, "/");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Deletar cookie
if (isset($_GET['deletar'])) {
    $nome = $_GET['deletar'];
    setcookie($nome, '', time() - 3600, "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gerenciador de Cookies</title>
</head>

<body>

    <h2>🍪 Cookies atuais</h2>

    <?php
if (!empty($_COOKIE)) {
    foreach ($_COOKIE as $chave => $valor) {
        echo "$chave = $valor ";
        echo "<a href='?deletar=$chave'>[Deletar]</a><br>";
    }
} else {
    echo "Nenhum cookie encontrado.<br>";
}
?>

    <hr>

    <h2>Criar / Alterar Cookie</h2>

    <form method="POST">
        Nome: <input type="text" name="nome"><br><br>
        Valor: <input type="text" name="valor"><br><br>
        <button type="submit">Salvar</button>
    </form>

</body>

</html>