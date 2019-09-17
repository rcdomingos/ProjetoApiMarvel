<?php

// função para gerar a url do personagem
function gerarUrl($busca, $type)
{
    // informações padrão para acessar a API:
    $date = new DateTime();
    $ts = $date->getTimestamp();
    $publicKey = "56d710241b50909a9ad692a421aff304";
    $privatKey = "9f7b12929a3711df4ec523cb3e00bbf2c65c35f8";
    $hash = md5($ts . $privatKey . $publicKey);

    switch ($type) {
        case 'personagem':
            $nameCharacter = $busca;
            return $urlName = "http://gateway.marvel.com/v1/public/characters?id=$nameCharacter&ts=$ts&apikey=$publicKey&hash=$hash"; //Personagens pelo nome
            break;

        case 'comics':
            $idPersonagem = $busca;
            return $urlComics = "http://gateway.marvel.com/v1/public/characters/$idPersonagem/comics?ts=$ts&apikey=$publicKey&hash=$hash";
            break;

        case 'listaPersonagens':
            //$limit = "total": 1492,
            return $urlComics = "http://gateway.marvel.com/v1/public/characters?limit=50&ts=$ts&apikey=$publicKey&hash=$hash";
            break;

        case 'lupaPersonagens':
            $nameStart = $busca;
            return $urlStartWith = "https://gateway.marvel.com/v1/public/characters?nameStartsWith=$nameStart&ts=$ts&apikey=$publicKey&hash=$hash";
            break;

        default:
            $nameStart = $busca;
            return $urlStartWith = "https://gateway.marvel.com:443/v1/public/characters?nameStartsWith=$nameStart&ts=$ts&apikey=$publicKey&hash=$hash";
            break;
    }
}

//função para gerear imprimir os cards
function gerarInformacoes($nomePesquisa)
{
    $url = gerarUrl($nomePesquisa, 'personagem');

    //buscando o arquivo json
    $json = file_get_contents($url);
    $dados = json_decode($json, false);

    if ($dados->data->count > 0) {
        // echo "verdadeiro</br>";
        // echo $dados->data->total . "</br>";
        $nomePersonagem = $dados->data->results[0]->name;
        $descPersonagem = $dados->data->results[0]->description;
        $imgPersonagem = $dados->data->results[0]->thumbnail->path . "/standard_fantastic." . $dados->data->results[0]->thumbnail->extension;
        $revistas = gerarRevistas($dados->data->results[0]->id);
        $atribuition = $dados->attributionHTML;
    } else {
        // echo "False</br>";
        // echo $dados->data->total . "</br>";
        $nomePersonagem = '';
        $descPersonagem = '';
        $imgPersonagem = '';
        $revistas = '';
    }

    $infoPersonagem = array('nome' => $nomePersonagem, 'descricao' => $descPersonagem, 'imagem' => $imgPersonagem, 'revista' => $revistas, 'atribuition' => $atribuition);
    return $infoPersonagem;
}

//função para testar a coneção da url informada
function testarConexaoUrl($url)
{
    $h = @get_headers($url);
    if ($h == false) {
        return false;
    } else {
        $status = array();
        preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0], $status);

        // return ($status[1] == 200);
        return $status[1];
    }
}

//função para pegar 3 revistas aleatorios do personagem
function gerarRevistas($idPersonagem)
{
    $url = gerarUrl($idPersonagem, 'comics');
    //echo $url;
  
    //buscando o arquivo json
    $json = file_get_contents($url);
    $dados = json_decode($json, false);
    $qtdRevista = 3;

    if ($dados->data->count >= $qtdRevista) {
        $revistas = $dados->data->results;
        $rand_keys = array_rand($revistas, $qtdRevista);

        for ($i = 0; $i < $qtdRevista; $i++) {
            $comics[$i] = array('title' => $revistas[$rand_keys[$i]]->title, 'cover' => $revistas[$rand_keys[$i]]->thumbnail->path . "/portrait_uncanny." . $revistas[$rand_keys[$i]]->thumbnail->extension);
        }
    } else {
        for ($i = 0; $i < $qtdRevista; $i++) {
            $comics[$i] = array('title' => "Not Found", 'cover' => "img/not-found.jpg");
        }
    }
    // $comics = array($revista1, $revista2, $revista3);
    //print_r($comics);

    return $comics;

}

/** */
function gerarPesquisa($nomePesquisa)
{
    $url = gerarUrl($nomePesquisa, 'lupaPersonagens');

    $status = testarConexaoUrl($url);

    if ($status) {
        //buscando o arquivo json
        $json = file_get_contents($url);
        $dados = json_decode($json, false);

        if ($dados->data->total > 0) {

            $nomes = $dados->data->results;
            $count = $dados->data->count;

            for ($i = 0; $i < $count; $i++) {
                $imgPersonagem[$nomes[$i]->id] = $nomes[$i]->thumbnail->path . "/standard_fantastic." . $nomes[$i]->thumbnail->extension;
                $personagem[$nomes[$i]->id] = $nomes[$i]->name;
            }

        } else {
            $imgPersonagem[1009652] = "img/not-found.jpg";
            $personagem[1009652] = "Not Found";
        }

        $infoPersonagem = array('nome' => $personagem, 'imagem' => $imgPersonagem);
        // print_r($infoPersonagem);
        // var_dump($nomes);
        // var_dump($infoPersonagem);
        return $infoPersonagem;
    }
}
