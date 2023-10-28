<?php

namespace LaboratorioRedis;

class Sorteio {
    private int $id = 0;
    private string $data = "";
    private string $numeros = "";
    private int $ganhadores = 0;

    public function __construct( int $id, string $data, string $numeros, int $ganhadores ){
        $this->setId( $id );
        $this->setData( $data );
        $this->setNumeros( $numeros );
        $this->setGanhadores( $ganhadores );
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
     * Método responsável por retornar chave formatada para cadastro no Redis
     * Exemplo: 1:resultado:2023-10-10:megasena
     *
     * @return string
     */
    public function obterChaveFormatadaParaCadastroNoRedis() :string {
        return "{$this->getId()}:resultado:{$this->getData()}:megasena";
    }

    /**
     * Método responsável por retornar o valor formatado para cadastro no Redis
     * Exemplo: '{ "numeros" : "2, 3 , 4, 5", "ganhadores" : 10 }'
     * @return string
     */
    public function obterValorFormatadoParaCadastroNoRedis() :string {
        return '{ "numeros" : "' . $this->getNumeros() . '", "ganhadores" : ' . $this->getGanhadores() . ' }';
    }

    /**
     * Método responsável por exibir o sorteio usando HTML.
     *
     * @return void
     */
    public function exibirSorteio() :void {
        $conteudo = <<<HTML
            <h1>Sorteio - {$this->getData()}</h1>
            <ul>
                <li>Número: {$this->getId()}</li>
                <li>Números sorteados: {$this->getNumeros()}</li>
                <li>Número de ganhadores: {$this->getGanhadores()}</li>
            </ul>
        HTML;

        echo $conteudo;
    }
}