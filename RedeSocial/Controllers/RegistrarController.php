<?php 
    namespace RedeSocial\Controllers;
    class RegistrarController{
        public function index(){
            if(isset($_POST['registrar'])){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];

                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    \RedeSocial\Utilidades::alerta('Email ou senha inválidos');
                    \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'registrar');
                }else if(strlen(($senha) < 6)){
                    \RedeSocial\Utilidades::alerta('Senha deve ter no mínimo 6 caracteres.');
                    \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'registrar');
                }else if(\RedeSocial\Models\UsuariosModel::exmailExists($email)){
                    \RedeSocial\Utilidades::alerta('Email ou senha inválidos.');
                    \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'registrar');
                }else{
                    $senha = \RedeSocial\Bcrypt::hash($senha);
                    $registro = \RedeSocial\MySQL::connect()->prepare("INSERT INTO usuarios VALUES (null,?,?,?,'','')");
                    $registro->execute(array($nome,$email,$senha));

                    \RedeSocial\Utilidades::alerta('Registrado com sucesso!');
                    \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
                }
            }
            \RedeSocial\Views\MainView::render('registrar');
        }
    }
?>