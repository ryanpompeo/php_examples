<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipulacao String</title>
</head>

<body>
    <h1>Manipulacao String</h1>

    <?php 
    $NOME = "Student PHP";
    echo "<p>Olá, $NOME! Bem-vindo</p>";
    echo '<p>Olá,  $NOME</p>';
    echo"\n";
    echo <<< EOT
    Olá', $NOME! Bem-vindo ao curso de PHP. Strings de múltiplas linhas usando a sintaxe HEREDOC.
    EOT;
    
    ?>

</body>

</html>