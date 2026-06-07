<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Produtos</title>
</head>
<body>
  <h1>📦Cadastro de Produtos</h1>
  <hr>

  <?php  
      $produto = $_REQUEST['produto'];
      $quantidade = $_REQUEST['quantidade'];

      if (empty($produto) || empty($quantidade)) {
        echo "Preencha todos os campos";
      } else {
        echo "<b>Produto:</b> $produto";
        echo "<br>";
        echo "<b>Quantidade:</b> $quantidade";
      }
  ?>

  <hr>
  <button type="button" onclick="history.back()">⬅️ Voltar</button>
  
</body>
</html>