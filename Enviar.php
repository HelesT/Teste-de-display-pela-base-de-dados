<?php
include("conecta.php");

$mensagem = ""; // Mensagem inicial vazia

if(isset($_POST['bloco_amarelo'])) {
  $letra = "s"; // Letra a ser armazenada na coluna 'nome'

  // Verificar se já existe um registro com a mesma letra na tabela 'verificacao'
  $sqlVerifica = "SELECT * FROM verificacao WHERE nome = :letra";
  $stmtVerifica = $pdo->prepare($sqlVerifica);
  $stmtVerifica->bindParam(':letra', $letra);
  $stmtVerifica->execute();
  
  if($stmtVerifica->rowCount() > 0) {
    // Se já existir registro, exibir mensagem
    $mensagem = "Você já adicionou esse produto no carrinho.";
  } else {
    // Se não existir registro, realizar a inserção na tabela 'verificacao'
    $sqlInserir = "INSERT INTO verificacao (nome) VALUES (:letra)";
    $stmtInserir = $pdo->prepare($sqlInserir);
    $stmtInserir->bindParam(':letra', $letra);
    
    if($stmtInserir->execute()) {
      // Inserção realizada com sucesso
      // Você pode adicionar alguma outra lógica ou redirecionamento aqui, se necessário
    } else {
      // Erro ao inserir
      $mensagem = "Erro ao adicionar o produto no carrinho.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar</title>
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
        display: flex;
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
    .mensagem {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #ffcc00;
        color: #000;
        text-align: center;
        padding: 10px;
    }
</style>
<body>
    <?php
    if(!empty($mensagem)) {
        echo '<div class="mensagem">' . $mensagem . '</div>';
    }
    ?>
    <form method="POST" action="">
        <div class="bloco_preto" id="bloco_preto">
            <button type="submit" name="bloco_amarelo" class="bloco_amarelo" id="bloco_amarelo"></button>
        </div>
    </form>
</body>
</html>
