<?php

namespace src\Db;

use \PDO;
use PDOException;

class Database {
    /**
     * Host de conexão com o banco de dados.
     * @var string
     */
    const HOST = 'mysql-container';

    /**
     *
     * @var string
     */
    const NAME = 'vagas';

    /**
     *
     * @var string
     */
    CONST USER = 'root';

    /**
     *
     * @var string
     */
    const PASS = 'root';

    /**
     *Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instancia a conexão
     * @var string
     */
    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsavel por criar uma conexão com o banco de dados
     */
    private function setConnection() {
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';
            dbname='.self::NAME,self::USER,self::PASS,array(PDO::ATTR_PERSISTENT => true));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Método responsavel por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []) {
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * @param array $values [ field => value ]
     * @return integer ID inserido
     */
    public function insert($values) {
        //Dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        //Monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

        //Executa o INSERT
        $this->execute($query, array_values($values));

        //Retona o ID iserido
        return $this->connection->lastInsertId();
    }

    /**
     * Metodo responsavel por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string @limit 
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*') {
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        return $this->execute($query);
    }

    /**
     * Método responsável por executar atualizações no banco de dados.
     * @param string $where
     * @param array $values
     * @param boolean
     */
    public function update($where, $values) {
        //Dados da Query
        $fields = array_keys($values);

        //Monta a Query
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,', $fields). '=? WHERE '.$where;

        //Executa a Query
        $this->execute($query, array_values($values));

        return true;
    }

    /**
     * Método responsável por excluir  os dados do banco
     * @param 
     * @return
     */
    public function delete($where) {
        //Monta a query de exclusão
        $query = 'DELETE FROM '.$this->table.' WHERE '. $where;

        //Executa a query
        $this->execute($query);

        //Retorna sucesso
        return true;
    }
}