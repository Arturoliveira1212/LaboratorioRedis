<?php

require __DIR__ . '/../vendor/autoload.php';

use LaboratorioRedis\Loteria;

$dataInicial = new DateTime( "1999-10-10" );
$dataAtual = new DateTime();

define( "SABADO", 6 );
define( "QUARTA_FEIRA", 3 );

$id = 1;
while( $dataInicial < $dataAtual ){
    $diaDaSemana = date( 'w', strtotime( date($dataInicial->format("Y-m-d")) ) );

    if( $diaDaSemana == SABADO || $diaDaSemana == QUARTA_FEIRA ){
        $loteria = new Loteria();
        $sorteio = $loteria->realizarSorteio( $id, $dataInicial );
        $loteria->salvarSorteio( $sorteio );
        $id++;
    }

    $dataInicial->modify( "+ 1 day" );
}