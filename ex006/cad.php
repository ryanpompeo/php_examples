<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <head>
        <h1>Resultado</h1>
    </head>

    <main>

        <?php 
        var_dump($_REQUEST); // $_REQUEST é um array que contém os dados enviados por GET, POST e COOKIE. Ele é uma combinação de $_GET, $_POST e $_COOKIE. O var_dump() é usado para exibir o conteúdo do array $_REQUEST, mostrando os dados enviados pelo formulário ou pela URL.
        
        $_NOME = $_POST['nome'] ?? 'Desconecido'; // $_GET é um array associativo que contém os dados enviados por meio do método GET. Ele é usado para acessar os valores dos parâmetros passados na URL. O operador de coalescência nula (??) é usado para fornecer um valor padrão ('Desconecido') caso o parâmetro 'nome' não esteja presente na URL.
        echo "<p>Olá, $_NOME! Bem-vindo ao curso de PHP!</p>";
        ?>

    </main>

</body>

</html>