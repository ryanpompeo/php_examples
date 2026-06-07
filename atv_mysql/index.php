<?php
session_start();


$host = '143.106.241.3'; 
$db   = 'cl203420'; 
$user = 'cl203420';  
$pass = 'cl*09082007';

// Conexão com o XAMPP Local
// $host = 'localhost'; 
// $db   = 'mysql'; // Altere para o nome do banco que você criou no seu phpMyAdmin local
// $user = 'root';     // Usuário padrão de fábrica do XAMPP
// $pass = '';         // Senha padrão do XAMPP (vazia)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão local: " . $e->getMessage());
}
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco.");
}

// Processa o formulário de criação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_criacao = $_POST['data_criacao'] ?? '';
    $cor_tematica = $_POST['cor_tematica'] ?? '#3b82f6';
    $senha_acesso = $_POST['senha_acesso'] ?? ''; 
    
   
    $categorias_array = $_POST['categorias'] ?? [];
    $categorias = implode(', ', $categorias_array);

    if ($nome != '' && $senha_acesso != '') {
        $sql = "INSERT INTO lojas (nome, descricao, data_criacao, cor_tematica, senha_acesso, categorias) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $data_criacao, $cor_tematica, $senha_acesso, $categorias]);
        
     
        $_SESSION['loja_id'] = $pdo->lastInsertId();
        header("Location: loja.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Criar Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-gray-800 rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-400 border-b border-gray-700 pb-2">Criar Nova Loja</h2>

        <form method="POST" action="index.php" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">Nome da Loja</label>
                    <input type="text" name="nome" required class="w-full p-2 bg-gray-700 rounded text-white mt-1">
                </div>
                <div>
                    <label class="block text-sm">Senha de Acesso</label>
                    <input type="text" name="senha_acesso" required
                        class="w-full p-2 bg-gray-700 rounded text-white mt-1">
                </div>
            </div>

            <div>
                <label class="block text-sm">Descrição</label>
                <textarea name="descricao" rows="2" class="w-full p-2 bg-gray-700 rounded text-white mt-1"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">Data de Criação</label>
                    <input type="date" name="data_criacao" required
                        class="w-full p-2 bg-gray-700 rounded text-white mt-1">
                </div>
                <div>
                    <label class="block text-sm">Cor Temática</label>
                    <input type="color" name="cor_tematica" value="#3b82f6" class="mt-1 h-10 w-16 cursor-pointer">
                </div>
            </div>

            <div>
                <label class="block text-sm mb-2">Categorias</label>
                <div class="grid grid-cols-3 gap-2 text-sm bg-gray-700 p-3 rounded">
                    <label><input type="checkbox" name="categorias[]" value="Alimentação"> Alimentação</label>
                    <label><input type="checkbox" name="categorias[]" value="Vestuário"> Vestuário</label>
                    <label><input type="checkbox" name="categorias[]" value="Eletrônicos"> Eletrônicos</label>
                </div>
            </div>

            <button type="submit" class="w-full p-3 bg-blue-600 hover:bg-blue-700 rounded font-bold mt-4">Salvar
                Loja</button>
        </form>
    </div>

</body>

</html>