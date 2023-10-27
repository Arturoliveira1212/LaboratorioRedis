<?php

// Carrega o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

use Predis\Client;
use LaboratorioRedis\Sorteio;

$sorteio = new Sorteio( 10, '2023-10-22' );

// Crie uma nova instância do cliente Redis
$redis = new Client();

// Armazene um valor no Redis
$redis->set('chave', 'artur');

$tamplateChave = "resultado:*2023-11-*:megasena";
$chaves = $redis->keys( $tamplateChave );

foreach( $chaves as $chave ){
    $ganhadores = $redis->hget( $chave, "ganhadores" );
    $numeroSorteados = $redis->hget( $chave, "numerosSorteados" );
}

// Recupere um valor do Redis
$valor = $redis->get('chave');
echo "Valor: $valor";