<?php

require_once __DIR__ . '/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Session\Login;

//Obriga o ususario a estar logado
Login::requireLogout();

//mensagem de alerta dos formualrios
$alertaLogin = '';
$alertaCadastro = '';

if(isset($_POST['acao'])) {
    switch($_POST['acao']) {
        case 'logar':

            //Busca usuario por email
            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

            //Valida a instancia e a senha
            if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)) {
                $alertaLogin = 'E-mail ou senha inválidos';
                break;
            }

            //Loga usuario
            Login::login($obUsuario);
        
        case 'cadastrar':
            //Validação dos campos obrigatorios
            if(isset($_POST['nome'], $_POST['email'], $_POST['senha'],)) {

                //Busca usuario por email
                $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
                if($obUsuario instanceof Usuario) {
                    $alertaCadastro = 'O e-mail digitado já está em uso';
                    break;
                }

                //Novo usuario
                $obUsuario = new Usuario;
                $obUsuario->nome = $_POST['nome'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->cadastrar();
                Login::login($obUsuario);
            }
            break;
    }
}


include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/formulario-login.php';
include_once __DIR__ . '/includes/footer.php';