<?php

require __DIR__ . '/../vendor/autoload.php';

use LaboratorioRedis\Loteria;

$loteria = new Loteria();

$sorteioNumero1 = $loteria->obterSorteioComNumero( 1 );
$sorteioNumero1->exibirSorteio();
$sorteioData = $loteria->obterSorteioComData( "1999-10-13" );
$sorteioData->exibirSorteio();