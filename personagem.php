<?php
require_once "dados.php";

$personagem = gerarInformacoes($_GET['id']);
// echo gerarUrl('Spider-Man', 'personagem');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Bangers|DM+Serif+Text&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <title>Personagens Marvel</title>
  <!-- <style>   .main{ background: url(<?php echo $personagem['imagem'] ?>) no-repeat right top}   </style> -->
</head>

<body>
  <div class="grid-personagem">
    <header class="header">
      <img id="logo" src="img/MarvelLogo.svg" alt="Logo Marvel com os herois">
    </header>
    <div class="main">
      <span id="span-perso">
        <div id='voltar'>
          <a href="index.php">Voltar</a>
        </div>
        <div class="foto-personagem">
          <img src="<?php echo $personagem['imagem'] ?>" alt="imagem: <?php echo $personagem['nome'] ?>">
          <div class="legenda"><?php echo $personagem['nome'] ?></div>
        </div>
        <div class="texto-personagem">
          <h2 class="fonte-vermelho"><?php echo $personagem['nome'] ?></h2>
          <p><?php echo $personagem['descricao'] ?></p>
        </div>

      </span>
    </div>
    <div class="revistas">
      <h2>Quadrinhos</h2>
      <div class="subgrid">
        <div class="revista">
          <figure>
            <img src="<?php echo $personagem['revista'][0]['cover'] ?>" alt="capa da revista: <?php echo $personagem['revista'][0]['title'] ?>" >
            <figcaption><?php echo $personagem['revista'][0]['title'] ?></figcaption>
          </figure>
        </div>
        <div class="revista">
          <figure>
            <img src="<?php echo $personagem['revista'][1]['cover'] ?>" alt="capa da revista: <?php echo $personagem['revista'][1]['title'] ?>" >
            <figcaption><?php echo $personagem['revista'][1]['title'] ?></figcaption>
          </figure>
        </div>
        <div class="revista">
          <figure>
            <img src="<?php echo $personagem['revista'][2]['cover'] ?>" alt="capa da revista: <?php echo $personagem['revista'][2]['title'] ?>">
            <figcaption><?php echo $personagem['revista'][2]['title'] ?></figcaption>
          </figure>
        </div>
      </div>
    </div>
    <div class="footer">
      <img id="logo-footer" src="img/Marvel-Character-Rights.jpg" alt="Logo com os personagens da marvel">
      <p><small>Desenvolvido por Reginaldo C Domingos </small></p>
      <p><small> <?php echo $personagem['atribuition'] ?> </small></p>
    </div>
  </div>
</body>

</html>