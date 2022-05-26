<?php

include "conectaBanco.php";

$codigoEstado = $_GET['codigoEstado'];

$sqlCidades = "SELECT codigoCidade, nomeCidade FROM cidades WHERE codigoEstado=:codigoEstado";


$sqlCidadesST = $conexao->prepare($sqlCidades);
$sqlCidadesST->bindValue(':codigoEstado', $codigoEstado);

$sqlCidadesST->execute();
$resultadoCidades = $sqlCidadesST->fetchALL();

echo "<option value=\"\">Escolha a cidade</option>\n";

foreach ($resultadoCidades as list($codigoCidade, $nomeCidade)){
    if (!empty($codigoCidade) && $codigoCidade == $codigoCidade) {
        $selected = 'selected';
    } else {
        $selected = '';
    }
    echo "<option value=\"$codigoCidade\" $selected>$nomeCidade</option>";
}

?>