<?php

namespace Vagas\Db;

class Pagination {
    /**
     * Número maximo de registros por página
     * @var integer
     */
    private $limit;

    /**
     * Quantidade total de resultados do banco
     * @var integer
     */
    private $results;

    /**
     * Quantidade de paginas
     * @var integer
     */
    private $pages;

    /**
     * Página atual
     * @var integer
     */
    private $currentPage;

    /**
     * Construtor da classe
     * @param integer $results
     * @param integer $currentPage
     * @param integer $limit
     */
    public function __construct($results, $currentPage, $limit = 10) {
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage: 1;
        $this->calculate();
    }

    /**
     * Método resposnavel por calcular a paginaação 
     */
    private function calculate() {
        //Calcula o total de páginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        //verifica se a página atual não excede o numero de páginas
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    /**
     * Método responsavel por retornar a clausula limit da sql
     * @return string
     */
    public function getLimit() {
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    /**
     * Método responsavel por retornar as opções de páginas disponiveis
     * @return array
     */
    public function getPages() {
        //Não retorna paginas
        if($this->pages == 1) return [];

        $paginas = [];
        for($i = 1; $i <= $this->pages; $i++) {
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentPage
            ];
        }
        return $paginas;
    }


}