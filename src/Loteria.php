<?php

namespace LaboratorioRedis;

use DateTime;
use Predis\Client;

class Loteria {
    /**
     * Método responsável por gerar um sorteio de número aleatórios de 1 a 60
     *
     * @return string
     */
    public function gerarNumerosSorteados() : string {
        $numerosSorteados = array();

        for( $i = 0; $i < 6; $i++ ){
            $numeroAleatorio = rand( 1, 60 );
            $numerosSorteados[] = $numeroAleatorio;
        }

        return implode( ",", $numerosSorteados );
    }

    /**
     * Método responsável por gerar um número de ganhadores aleatórios de 0 a 20
     *
     * @return integer
     */
    public function gerarNumeroGanhadores() : int {
        return rand( 1, 20 );
    }

    /**
     * Método responsável por realizar e retornar o sorteio.
     *
     * @param integer $id
     * @param DateTime $data
     * @return Sorteio
     */
    public function realizarSorteio( int $id, DateTime $data ) :Sorteio {
        $numerosSorteados = $this->gerarNumerosSorteados();
        $ganhadores = $this->gerarNumeroGanhadores();
        $sorteio = new Sorteio( $id, $data->format("Y-m-d"), $numerosSorteados, $ganhadores );

        return $sorteio;
    }

    /**
     * Método responsável por salvar o sorteio no Redis.
     *
     * @param Sorteio $sorteio
     * @return void
     */
    public function salvarSorteio( Sorteio $sorteio ) :void {
        $chave = $sorteio->obterChaveFormatadaParaCadastroNoRedis();
        $valor = $sorteio->obterValorFormatadoParaCadastroNoRedis();
        $redis = new Client();
        $redis->set( $chave, $valor );
    }

    /**
     * Método responsável por obter um sorteio com seu número/id.
     *
     * @param integer $numero
     * @return Sorteio|null
     */
    public function obterSorteioComNumero( int $numero ) :?Sorteio {
        $redis = new Client();
        $tamplateChave = "$numero:resultado:*:megasena";
        $chave = array_shift( $redis->keys( $tamplateChave ) );
        if( $chave != null ){
            $valor = $redis->get( $chave );
            $sorteio = $this->transformarDadosDoSorteioEmObjeto( $chave, $valor );
            return $sorteio;
        }

        return null;
    }

    /**
     * Método responsável por obter um sorteio pela sua data.
     *
     * @param string $data
     * @return Sorteio|null
     */
    public function obterSorteioComData( string $data ) :?Sorteio {
        $redis = new Client();
        $tamplateChave = "*:resultado:$data:megasena";
        $chave = array_shift( $redis->keys( $tamplateChave ) );
        if( $chave != null ){
            $valor = $redis->get( $chave );
            $sorteio = $this->transformarDadosDoSorteioEmObjeto( $chave, $valor );
            return $sorteio;
        }

        return null;
    }

    /**
     * Método responsável por transformar a chave e o valor obtido do Redis em um objeto de Sorteio.
     *
     * @param string $chave
     * @param string $valor
     * @return Sorteio
     */
    private function transformarDadosDoSorteioEmObjeto( string $chave, string $valor ) :Sorteio {
        $dadosChaveEmArray = explode( ":", $chave );
        $idSorteio = $dadosChaveEmArray[0];
        $data = $dadosChaveEmArray[2];

        $dadosValor = json_decode( $valor );
        $numerosSorteados = $dadosValor->numeros;
        $ganhadores = $dadosValor->ganhadores;

        $sorteio = new Sorteio( $idSorteio, $data, $numerosSorteados, $ganhadores );

        return $sorteio;
    }
}