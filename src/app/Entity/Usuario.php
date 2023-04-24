<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario{

    /**
     * Identificador do usuario
     * @var integer
     */
    public $id;

    /**
     * Nome do Usuario
     * @var string
     */
    public $nome;

    /**
     * Email do Usuario
     * @var string
     */
    public $email;

    /**
     * Hash de senha do usuário
     * @var string
     */
    public $senha;

    /**
     * Método responsavel por cadastrar um novo usuario no banco
     * @return boolean
     */
    public function cadastrar() {
        //Database
        $obDatabase = new Database('usuarios');

        //Insere um novo usuario
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);

        return true;
    }

    public static function getUsuarioPorEmail($email) {
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
        
    }
}