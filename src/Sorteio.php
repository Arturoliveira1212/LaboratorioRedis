<?php

namespace LaboratorioRedis;

class Sorteio {
    private int $id = 0;
    private string $data = "";
    private string $numeros = "";
    private int $ganhadores = 0;

    public function __construct( int $id, string $data ){
        $this->setId( $id );
        $this->setData( $data );
        $this->setNumeros(  $this->gerarNumerosSorteados() );
        $this->setGanhadores( $this->gerarNumeroGanhadores() );
    }

    public function getId() :int {
        return $this->id;
    }

    public function setId( int $id ){
        $this->id = $id;
    }

    public function getData() :string {
        return $this->data;
    }

    public function setData( string $data ){
        $this->data = $data;
    }

    public function getNumeros() :string {
        return $this->numeros;
    }

    public function setNumeros( string $numeros ){
        $this->numeros = $numeros;
    }

    public function getGanhadores() :int {
        return $this->ganhadores;
    }

    public function setGanhadores( int $ganhadores ){
        $this->ganhadores = $ganhadores;
    }

    /**
     * Método responsável por gerar um sorteio de número aleatórios de 1 a 60
     *
     * @return string
     */
    public function gerarNumerosSorteados(){
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
    public function gerarNumeroGanhadores(){
        return rand( 1, 20 );
    }

    /**
     * Método responsável por retornar chave formatada para cadastro no Redis
     * Exemplo: 1:resultado:2023-10-10:megasena ganhadores 3 numeros "1111"
     *
     * @return string
     */
    public function obterChaveFormatadaParaCadastroNoRedis(){
        return "{$this->getId()}:resultado:{$this->getData()}:megasena";
        // return "{$this->getId()}:resultado:{$this->getData()}:megasena ganhadores {$this->gerarNumeroGanhadores()} numeros {$this->gerarNumerosSorteados()}";
    }


}