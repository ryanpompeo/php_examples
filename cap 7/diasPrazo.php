<h1>Prazo Informado pelo Usuário</h1>

<form method="GET">
    Informe o prazo:<br>
    <input type="date" name="prazo">
    <button type="submit">Verificar</button>
</form>

<?php
    $dataPrazo = $_GET['prazo'] ?? null;

    if ($dataPrazo) {

        $prazoUsuario = new DateTime($dataPrazo);
        $hoje = new DateTime();

        if ($prazoUsuario <= $hoje) {
            echo "<p>O prazo expirou.</p>";
        } else {
            $faltam = $hoje->diff($prazoUsuario);
            echo "<p>Faltam {$faltam->days} dias para o prazo.</p>";
        }
    }
?>