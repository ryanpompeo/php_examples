<?php
// 1. CONEXÃO COM O BANCO DE DADOS
// Estabelece a conexão com o servidor MySQL. Como o bloco try-catch foi removido, 
$host = '143.106.241.3';
$db   = 'cl203420';
$user = 'cl203420';
$pass = 'cl*09082007';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

// 2. LÓGICA DE EXCLUSÃO (DELETE)
// Verifica se a URL contém a query string 'delete' (ex: index.php?delete=5).
// O acionamento vem do clique no link "Excluir" na tabela HTML.
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Executa a instrução SQL diretamente no banco para remover a linha correspondente ao ID.
    $pdo->query("DELETE FROM funcionarios WHERE id = $id");
    // Redireciona o navegador para a raiz da página para limpar o parâmetro "?delete=X" da URL.
    header("Location: index.php");
    exit;
}

// 3. LÓGICA DE CRIAÇÃO E ATUALIZAÇÃO (INSERT/UPDATE)
// Intercepta a requisição de forma global se os dados vieram do botão "submit" do formulário HTML.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados empacotados pelo navegador. O operador "??" garante que, se o ID não existir, ele assume string vazia.
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];

    // O ID dita o fluxo. Oculto no HTML, se ele existe, estamos sobrescrevendo algo que já está no banco.
    if ($id) {
        // Executa o UPDATE. As variáveis PHP são injetadas diretamente na string SQL.
        $pdo->query("UPDATE funcionarios SET nome='$nome', email='$email', telefone='$telefone', cargo='$cargo', status='$status' WHERE id=$id");
    } else {
        // Se não há ID preenchido, é um novo registro. Executa o INSERT.
        $pdo->query("INSERT INTO funcionarios (nome, email, telefone, cargo, status) VALUES ('$nome', '$email', '$telefone', '$cargo', '$status')");
    }
    
    // Padrão PRG (Post/Redirect/Get). Força o navegador a carregar a página novamente via GET.
    // Isso evita o erro clássico de "Confirmar reenvio de formulário" se o usuário apertar F5.
    header("Location: index.php");
    exit;
}

// 4. LÓGICA DE BUSCA PARA EDIÇÃO (READ ESPECÍFICO)
$edit_data = null;
// Verifica se a URL contém a query string 'edit' (ex: index.php?edit=5).
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    // Executa um SELECT filtrado pelo ID para buscar os dados que já existem no banco.
    // O fetch(PDO::FETCH_ASSOC) transforma a linha do banco em um array associativo legível para o HTML.
    $edit_data = $pdo->query("SELECT * FROM funcionarios WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
}

// 5. LÓGICA DE LEITURA GERAL (READ TOTAL)
// Busca todos os registros da tabela, ordenando pelo ID do mais recente para o mais antigo.
// O fetchAll() cria uma matriz com todos os resultados para popularmos a tabela HTML.
$funcionarios = $pdo->query("SELECT * FROM funcionarios ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP - Básico e Inseguro</title>
</head>

<body>

    <h1>Sistema de Cadastro</h1>
    <hr>

    <h2><?= $edit_data ? 'Editar Funcionário' : 'Novo Cadastro' ?></h2>

    <form action="index.php" method="POST">
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">

        <p>
            <label>Nome Completo:</label><br>
            <input type="text" name="nome" value="<?= $edit_data['nome'] ?? '' ?>" required>
        </p>

        <p>
            <label>E-mail Corporativo:</label><br>
            <input type="email" name="email" value="<?= $edit_data['email'] ?? '' ?>" required>
        </p>

        <p>
            <label>Telefone:</label><br>
            <input type="text" name="telefone" value="<?= $edit_data['telefone'] ?? '' ?>" required>
        </p>

        <p>
            <label>Cargo / Função:</label><br>
            <input type="text" name="cargo" value="<?= $edit_data['cargo'] ?? '' ?>" required>
        </p>

        <p>
            <label>Status:</label><br>
            <select name="status">
                <option value="Ativo" <?= ($edit_data['status'] ?? '') === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="Inativo" <?= ($edit_data['status'] ?? '') === 'Inativo' ? 'selected' : '' ?>>Inativo
                </option>
            </select>
        </p>

        <p>
            <?php if($edit_data): ?>
            <button type="submit">Atualizar</button>
            <a href="index.php"><button type="button">Cancelar</button></a>
            <?php else: ?>
            <button type="submit">Cadastrar</button>
            <?php endif; ?>
        </p>
    </form>

    <hr>

    <h2>Registros Atuais</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Cargo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($funcionarios)): ?>
            <tr>
                <td colspan="7" align="center">Nenhum registro encontrado.</td>
            </tr>
            <?php else: ?>
            <?php foreach ($funcionarios as $func): ?>
            <tr>
                <td><?= $func['id'] ?></td>
                <td><?= $func['nome'] ?></td>
                <td><?= $func['email'] ?></td>
                <td><?= $func['telefone'] ?></td>
                <td><?= $func['cargo'] ?></td>
                <td><?= $func['status'] ?></td>
                <td>
                    <a href="index.php?edit=<?= $func['id'] ?>">Editar</a> |
                    <a href="index.php?delete=<?= $func['id'] ?>"
                        onclick="return confirm('Deseja realmente excluir este registro?');">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>