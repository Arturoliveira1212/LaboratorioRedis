<?php

// Carrega o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

use Predis\Client;

// Crie uma nova instância do cliente Redis
$redis = new Client();

// Armazene um valor no Redis
$redis->set('chave', 'artur');

// Recupere um valor do Redis
$valor = $redis->get('chave');
echo "Valor: $valor";