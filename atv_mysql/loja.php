<?php
session_start();

if (!isset($_SESSION['loja_id'])) {
    header("Location: index.php");
    exit;
}

$host = '143.106.241.3'; $db = 'cl203420'; $user = 'cl203420'; $pass = 'cl*09082007';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

$loja_id = $_SESSION['loja_id'];

// Logout
if (isset($_GET['sair'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $pdo->query("DELETE FROM lojas WHERE id = $loja_id");
    session_destroy();
    echo json_encode(["ok" => true]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $dados = json_decode(file_get_contents('php://input'), true);
    $nome = $dados['nome'];
    $descricao = $dados['descricao'];
    
    $stmt = $pdo->prepare("UPDATE lojas SET nome = ?, descricao = ? WHERE id = ?");
    $stmt->execute([$nome, $descricao, $loja_id]);
    echo json_encode(["ok" => true]);
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM lojas WHERE id = ?");
$stmt->execute([$loja_id]);
$loja = $stmt->fetch();


if (!$loja) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Painel - <?= htmlspecialchars($loja['nome']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen p-8">

    <div class="max-w-3xl mx-auto">
        <div class="bg-gray-800 p-6 rounded-lg border-l-8 flex justify-between items-center"
            style="border-color: <?= $loja['cor_tematica'] ?>;">
            <div>
                <h1 class="text-3xl font-bold"><?= htmlspecialchars($loja['nome']) ?></h1>
                <p class="text-gray-400 text-sm mt-1">Categorias: <?= htmlspecialchars($loja['categorias']) ?></p>
            </div>
            <a href="loja.php?sair=true"
                class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded text-sm font-bold">Logout</a>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg mt-6">
            <h3 class="text-lg font-bold mb-2">Descrição</h3>
            <p class="text-gray-300"><?= nl2br(htmlspecialchars($loja['descricao'])) ?></p>
        </div>

        <div class="mt-6 flex gap-4">
            <button onclick="abrirModal('modalEdicao')" class="bg-yellow-600 px-4 py-2 rounded font-bold">Editar
                Dados</button>
            <button onclick="abrirModal('modalExcluir')" class="bg-red-600 px-4 py-2 rounded font-bold">Excluir
                Loja</button>
        </div>
    </div>

    <div id="modalEdicao" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center">
        <div class="bg-gray-800 p-6 rounded-lg w-96">
            <h3 class="text-xl font-bold mb-4">Editar Loja</h3>
            <input type="text" id="novoNome" value="<?= htmlspecialchars($loja['nome']) ?>"
                class="w-full p-2 bg-gray-700 rounded mb-3 text-white">
            <textarea id="novaDesc"
                class="w-full p-2 bg-gray-700 rounded mb-4 text-white"><?= htmlspecialchars($loja['descricao']) ?></textarea>

            <div class="flex justify-end gap-2">
                <button onclick="fecharModal('modalEdicao')" class="bg-gray-600 px-3 py-1 rounded">Cancelar</button>
                <button onclick="salvarEdicao()" class="bg-yellow-600 px-3 py-1 rounded font-bold">Salvar</button>
            </div>
        </div>
    </div>

    <div id="modalExcluir" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center">
        <div class="bg-gray-800 p-6 rounded-lg w-96 text-center">
            <h3 class="text-xl font-bold text-red-500 mb-2">Atenção!</h3>
            <p class="mb-6">Deseja realmente apagar esta loja?</p>
            <div class="flex justify-center gap-4">
                <button onclick="fecharModal('modalExcluir')" class="bg-gray-600 px-4 py-2 rounded">Cancelar</button>
                <button onclick="deletarLoja()" class="bg-red-600 px-4 py-2 rounded font-bold">Sim, apagar</button>
            </div>
        </div>
    </div>

    <script>
    function abrirModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function fecharModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    async function salvarEdicao() {
        const dados = {
            nome: document.getElementById('novoNome').value,
            descricao: document.getElementById('novaDesc').value
        };

        await fetch('loja.php', {
            method: 'PUT',
            body: JSON.stringify(dados)
        });
        window.location.reload();
    }

    async function deletarLoja() {
        await fetch('loja.php', {
            method: 'DELETE'
        });
        window.location.href = 'index.php';
    }
    </script>
</body>

</html>