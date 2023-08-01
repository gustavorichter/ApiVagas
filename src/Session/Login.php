<?php

namespace Vagas\Session;

class Login {

    /**
     * Método resposavel por inciair a sessão
     */
    private static function init() {
        //Verifica o status da sessão
        if(session_status() !== PHP_SESSION_ACTIVE) {
            //Inicia a sessão
            session_start();
        }
    }

    public static function getUsaurioLogado() {
        //Inicia a sessão
        self::init();

        return self::isLogeed() ? $_SESSION['usuario'] : null;
    }

    public static function logout() {
         //Inicia a sessão
         self::init();

         //Remove a sessão de usuario
         unset($_SESSION['usuario']);

         //Redireciona usuario para login
         header('location: login.php');
         exit;
    }

    /**
     * Método resposnavel por logar o usuario
     * @param Usuario $obUsuario 
     */
    public static function login($obUsuario) {
        //Inicia a sessão
        self::init();

        $_SESSION['usuario'] = [
            'id' => $obUsuario->id,
            'nome' => $obUsuario->nome,
            'email' => $obUsuario->email
        ];

        //Redireciona para index
        header('location: index.php');
    }

    /**
     * Método que verefica se usuario logado
     * @return boolean
     */
    public static function isLogeed() {
        //Inicia a sessão
        self::init();
        return isset($_SESSION['usuario']['id']);
    }

    /**
     * Método que obriga o usuario a estar logado para acessar
     */
    public static function requireLogin() {
        if(!self::isLogeed()) {
            header('location: login.php');
            exit;
        }
    }

    /**
     * Método que obriga o usuario a estar deslogado para acessar
     */
    public static function requireLogout() {
        if(self::isLogeed()) {
            header('location: index.php');
            exit;
        }
    }



}