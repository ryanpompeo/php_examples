<?php
// 1. CONEXÃO COM O BANCO DE DADOS (XAMPP LOCAL)
$host = '143.106.241.3';
$db   = 'cl203420';
$user = 'cl203420';
$pass = 'cl*09082007';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão local. Certifique-se de que o MySQL do XAMPP está rodando.");
}


if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM funcionarios WHERE id = ?")->execute([$id]);
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE funcionarios SET nome=?, email=?, telefone=?, cargo=?, status=? WHERE id=?");
        $stmt->execute([$nome, $email, $telefone, $cargo, $status, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, email, telefone, cargo, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $cargo, $status]);
    }
    header("Location: index.php");
    exit;
}


$edit_data = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE id = ?");
    $stmt->execute([$id]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
}

$funcionarios = $pdo->query("SELECT * FROM funcionarios ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP </title>
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
                <td><?= htmlspecialchars($func['nome']) ?></td>
                <td><?= htmlspecialchars($func['email']) ?></td>
                <td><?= htmlspecialchars($func['telefone']) ?></td>
                <td><?= htmlspecialchars($func['cargo']) ?></td>
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