#!/usr/bin/env php
<?php

require 'vendor/autoload.php';
require 'omega/Buscador.php';

use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$httpclient = new Client(['base_uri' => 'https://www.alura.com.br', 'verify'=> false]);

$crawler = new Crawler();

$buscador = new Buscador($httpclient, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

echo "<pre>";
foreach ($cursos as $curso){
    echo $curso . PHP_EOL;
}
echo "</pre>";