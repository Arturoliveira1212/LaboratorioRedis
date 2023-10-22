<?php

namespace LaboratorioRedis;

class Sorteio {
    private int $id = 0;
    private string $data = "";
    private array $numeros = array();
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

    public function getNumeros() :array {
        return $this->numeros;
    }

    public function setNumeros( array $numeros ){
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
     * @return array
     */
    public function gerarNumerosSorteados(){
        $numerosSorteados = array();

        return $numerosSorteados;
    }

    /**
     * Método responsável por gerar um número de ganhadores aleatórios de 0 a 20
     *
     * @return integer
     */
    public function gerarNumeroGanhadores(){
        $numeroGanhadores = 0;

        return $numeroGanhadores;
    }
}