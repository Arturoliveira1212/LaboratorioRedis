<?php

// Carrega o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

use Predis\Client;
use LaboratorioRedis\Sorteio;

$dataInicial = new DateTime( "1999-10-10" );
$dataAtual = new DateTime();

define( "SABADO", 6 );
define( "QUARTA_FEIRA", 3 );

$id = 1;
while( $dataInicial < $dataAtual ){
    $diaDaSemana = date( 'w', strtotime( date($dataInicial->format("Y-m-d")) ) );

    if( $diaDaSemana == SABADO || $diaDaSemana == QUARTA_FEIRA ){
        $sorteio = new Sorteio( $id, $dataInicial->format("Y-m-d") );
        salvarSorteio( $sorteio );
        $id++;
    }

    $dataInicial->modify( "+ 1 day" );
}

function salvarSorteio( Sorteio $sorteio ){
    $redis = new Client();
    $chave = $sorteio->obterChaveFormatadaParaCadastroNoRedis();
    $redis->set( $chave, null );
    $redis->hset( $chave, "numeros", $sorteio->getNumeros() );
    $redis->hset( $chave, "ganhadores", $sorteio->getGanhadores() );
}
