<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do navegador</title>
</head>

<body>

    <h1>Dados do navegador</h1>
    <?php
    $user = [
        "sergio" => 32,
        "maria" => 28,
        "joao" => 45
    ];
    foreach ($user as $name => $age) {
        echo "<p>Nome: $name, Idade: $age</p>";
    }

    ?>
</body>

</html>