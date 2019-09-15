<?php
require_once "dados.php";

// echo gerarUrl('S', 'lupaPersonagens');

$nomeDigitado = isset($_POST['personagem']) ? $_POST['personagem'] : null;
$status = false;

if (!is_null($nomeDigitado)) {
    $Listapersonagens = gerarPesquisa($nomeDigitado);
    $status = true;
} else {
    $status = false;
}

// $Listapersonagens = gerarPesquisa('S');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Bangers|DM+Serif+Text&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <title>Personagens Marvel</title>
</head>

<body>
  <div class="grid-home">
    <header class="header">
      <img id="logo" src="img/MarvelLogo.svg" alt="Logo Marvel com os herois">
    </header>
    <div class="busca">
      <form autocomplete="off" id="form-buscar" method="post">
        <div class="autocomplete">
          <input type="search" name="personagem" id="personagem" placeholder="Digite o nome do Personagem">
        </div>
        <button id="botao-buscar" type="submit">Buscar</button>
      </form>
    </div>
    <div class="resultado">
<?php
// <?php echo $Listapersonagens['nome'][1009552]
if ($status) {
    echo "<section> <h2 class='fonte-vermelho'>Resultado da Busca</h2> <div class='lista-resultado'><nav><ol>";
    //lista de herois
    foreach ($Listapersonagens['nome'] as $key => $value) {
        echo "<li><a href='personagem.php?id=" . $key . "'>";
        echo "<figure><img src= '" . $Listapersonagens['imagem'][$key] . "'alt='Imagem: " . $Listapersonagens['nome'][$key] . "'>";
        echo "<figcaption>" . $Listapersonagens['nome'][$key] . "</figcaption></figure>";
        echo "</a></li>";
        // print_r($key);
        // print_r( $value);
    }
    echo "</ol></nav></div></section>";
} else {
    echo "<section class='pg-home'>";
    echo "<h2 class='fonte-vermelho'> Personagens Marvel</h2>";
    echo "<img src='img/the-marvel-universe.jpeg' alt='Personagens do Universo Marvel'>";
    echo "</section>";
}
?>
    </div>
    <div class="footer">
      <img id="logo-footer" src="img/Marvel-Character-Rights.jpg" alt="Logo com os personagens da marvel">
      <p><small>Desenvolvido por Reginaldo C Domingos </small></p>
      <p><small><a href="http://marvel.com">Data provided by Marvel. © 2019 MARVEL</a></small></p>
    </div>


  </div>
</body>
</html>
