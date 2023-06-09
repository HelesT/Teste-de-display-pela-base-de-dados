<?php
include("conecta.php");

// Consulta SQL para verificar se existe um registro na tabela 'verificacao' com id = 0 e nome = 's'
$sql = "SELECT * FROM verificacao WHERE id = 0 AND nome = 's'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
  // Se o registro existir, altere o estilo do bloco_preto para display: flex
  echo '<style>#bloco_preto { display: flex; }</style>';
}

// Verifica se o botão bloco_amarelo foi clicado
if (isset($_POST['bloco_amarelo'])) {
  // Deleta o registro com id = 0 da tabela 'verificacao'
  $sqlDelete = "DELETE FROM verificacao WHERE id = 0";
  $stmtDelete = $pdo->prepare($sqlDelete);
  $stmtDelete->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receber</title>
</head>
<style>
    body{
        width: 100%;
        height: 100vh;
        display: flex;
        background-color: blanchedalmond;
        justify-content: center;
        justify-items: center;
        align-items: center;
        align-content: center;
    }
    .bloco_preto{
        width: 100px;
        height: 100px;
        display: none;
        background-color: black;
        justify-content: center;
        justify-items: center;
        align-items: center;
        align-content: center;
    }
    .bloco_amarelo{
        width: 10px;
        height: 10px;
        display: flex;
        background-color: yellow;
        justify-content: center;
        justify-items: center;
        align-items: center;
        align-content: center;
    }    
</style>
<body>
    <form method="POST">
        <div class="bloco_preto" id="bloco_preto">
            <button type="submit" name="bloco_amarelo" class="bloco_amarelo" id="bloco_amarelo"></button>
        </div>
    </form>
</body>
</html>
