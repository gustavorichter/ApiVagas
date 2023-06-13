<?php

namespace Src\Entity;

use Src\Db\Database;

use \PDO;

class Vaga {
    /**
     * Identificador unico da vaga
     * @var integer
     */
    public $id;

    /**
     * Titulo da vaga
     * @var string
     */
    public $titulo;

    /**
     * Descrição da vaga
     * @var string
     */
    public $descricao;

    /**
     * Se a vaga está ativa ou não
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Data da vaga
     * @var string
     */
    public $data;

    public function cadastrar() {
        $this->data = date('Y-m-d H:i:s');

        $obDadatabase = new Database('vaga');
        $this->id = $obDadatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);
        return true;
    }

    /**
     * Método responsável por atualziar a vaga do banco
     * @return Boolean
     */
    public function atualizar($id, $data) {
        return (new Database('vaga'))->update('id = ' . $id, [
            'titulo' => $data['titulo'],
            'descricao' => $data['descricao'],
            'ativo' => $data['ativo'],
            'data' => $data['data']
        ]);
    }

    /**
     * Método responsavel por excluir a vaga
     * @return boolean
     */
    public function excluir() {
        return (new Database('vaga'))->delete('id = ' . $this->id);
    }

    /**
     * Metodo responsavel por obter as vagas do banco de dados
     * @param string $where
     * @param string $order
     * @param string @limit
     * @return array
     */
    public static function getVagas($where = null, $order = null, $limit = null) {
        return (new Database('vaga'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Metodo responsavel por obter a quantidade de vagas do banco de dados
     * @param string $where
     * @return array
     */
    public static function getQuantidadeVagas($where = null) {
        return (new Database('vaga'))->select($where, null, null, 'COUNT(*) AS qtd')
            ->fetchObject()
            ->qtd;
    }

    /**
     * Método resposnavel por buscar uma vaga com base em seu id
     * @param integer $id
     * @return Vaga
     */
    public static function getVaga($id) {
        return (new Database('vaga'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }
}