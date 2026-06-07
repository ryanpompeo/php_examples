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
    <form method="get">
        Nome: <input type="text" name="nome"><br><br>
        Valor: <input type="text" name="valor"><br><br>
        <button type="submit">Salvar</button>
    </form>
    <form method="get">
        Nome: <input type="text" name="nome"><br><br>

        <button type="submit">Salvar</button>
    </form>
    <?php 
    
    $texto = "Olá, mundo!";
    echo strlen($texto) . "<br>"; // Retorna o comprimento da string
    echo str_replace("mundo", "PHP", $texto) . "<br>"; //
    echo strtoupper($texto) . "<br>"; // Converte para maiúsculas
    echo strtolower($texto) . "<br>"; // Converte para minúsculas
    echo substr($texto, 0, 5) . "<br>"; // Retorna os primeiros 5 caracteres
    echo strrev($texto) . "<br>"; // Inverte a string   
    echo htmlspecialchars("<b>Texto em negrito</b>") . "<br>"; // Converte caracteres especiais para entidades HTML
    echo nl2br("Linha 1\nLinha 2\nLinha 3") . "<br>"; // Converte quebras de linha para <br>
    echo trim("   Texto com espaços   ") . "<br>"; // Remove espaços em branco do início e do fim da string
    echo str_repeat("PHP ", 3) . "<br>"; // Repete a string 3 vezes
    echo strpos($texto, "mundo") . "<br>"; // Retorna a posição da primeira ocorrência de "mundo"
    echo str_contains($texto, "mundo") ? "Contém 'mundo'" : "Não contém 'mundo'"; // Verifica se a string contém "mundo"       
    
    ?>

</body>

</html>