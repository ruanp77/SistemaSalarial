<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <h2>Calculadora de Salário</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nome">Nome do Vendedor:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="meta_semanal">Meta Semanal de Vendas (R$):</label><br>
        <input type="number" id="meta_semanal" name="meta_semanal" required><br><br>
        <label for="meta_mensal">Meta Mensal de Vendas (R$):</label><br>
        <input type="number" id="meta_mensal" name="meta_mensal" required><br><br>
        <input type="submit" value="Calcular Salário">
    </form>

    <?php
    // Função para calcular o salário final
    function calcularSalario($metaSemanal, $metaMensal) {
        $salarioMinimo = 1927.02;  // Salário mínimo no Paraná em 2022
        $valorMetaSemanal = $metaSemanal * 0.01;  // Valor sobre a meta semanal
        $excedenteSemanal = max(0, $metaSemanal - 20000);  // Excedente de meta semanal
        $valorExcedenteSemanal = $excedenteSemanal * 0.05;  // Valor sobre o excedente de meta semanal

        // Verifica se todas as metas semanais foram atingidas
        $todasAsSemanas = $metaSemanal >= 20000;

        // Calcula o excedente de meta mensal e seu valor, se aplicável
        if ($todasAsSemanas) {
            $excedenteMensal = max(0, $metaMensal - 80000);
            $valorExcedenteMensal = $excedenteMensal * 0.1;
        } else {
            $valorExcedenteMensal = 0;
        }

        // Calcula o salário final
        $salarioFinal = $salarioMinimo + $valorMetaSemanal + $valorExcedenteSemanal + $valorExcedenteMensal;

        return $salarioFinal;
    }

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $nome = $_POST['nome'];
        $metaSemanal = $_POST['meta_semanal'];
        $metaMensal = $_POST['meta_mensal'];

        // Calcula o salário final
        $salarioFinal = calcularSalario($metaSemanal, $metaMensal);

        // Exibe o resultado
        echo "<div class='result'>O salário final do vendedor(a) $nome é R$" . number_format($salarioFinal, 2) . "</div>";
    }
    ?>
</body>
</html>
