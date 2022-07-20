<?php 
    namespace RedeSocial\Controllers;
    class HomeController{
        public function index(){
            if(isset($_GET['loggout'])){
                session_unset();
                session_destroy();
                \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
            }
            if(isset($_SESSION['login'])){
                // Renderiza a Home do usuário

                //Existe pedido de amizade?
                if(isset($_GET['recusarAmizade'])){
					$idEnviou = (int) $_GET['recusarAmizade'];
					\RedeSocial\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,0);
					\RedeSocial\Utilidades::alerta('Amizade Recusada :(');
					\RedeSocial\Utilidades::redirect(INCLUDE_PATH);
				}else if(isset($_GET['aceitarAmizade'])){
					$idEnviou = (int) $_GET['aceitarAmizade'];
					if(\RedeSocial\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,1)){
					\RedeSocial\Utilidades::alerta('Amizade aceita!');
					\RedeSocial\Utilidades::redirect(INCLUDE_PATH);
					}else{
					\RedeSocial\Utilidades::alerta('Ops.. um erro ocorreu!');
					\RedeSocial\Utilidades::redirect(INCLUDE_PATH);
					}
				}
                //Existe postagem no feed?
				if(isset($_POST['post_feed'])){
					if($_POST['post_content'] == ''){
						\RedeSocial\Utilidades::alerta('Não permitimos posts vázios :(');
						\RedeSocial\Utilidades::redirect(INCLUDE_PATH);
					}
					\RedeSocial\Models\HomeModel::postFeed($_POST['post_content']);
					\RedeSocial\Utilidades::alerta('Post feito com sucesso!');
					\RedeSocial\Utilidades::redirect(INCLUDE_PATH);
				}

                \RedeSocial\Views\MainView::render('home');
            }else{
                // Renderizar Criar conta.
                if(isset($_POST['login'])){
                    $login = $_POST['email'];
                    $senha = $_POST['senha'];

                    //Verificar no banco de Dados
                    $verifica = \RedeSocial\MySQL::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
                    $verifica->execute(array($login));

                    if($verifica->rowCount() == 0){
                        //Não existe o usuário!
                        \RedeSocial\Utilidades::alerta('Email ou senha inválidos');
                        \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
                    }else{
                        $dados = $verifica->fetch();
                        $senhaBanco = $dados['senha'];
                        if(\RedeSocial\Bcrypt::check($senha, $senhaBanco)){
                            $_SESSION['login'] = $dados['email'];
                            $_SESSION['id'] = $dados['id'];
                            $_SESSION['nome'] = explode(' ', $dados['nome'])[0];
                            $_SESSION['img'] = $dados['img'];
                            \RedeSocial\Utilidades::alerta('Logado com sucesso!');
                            \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
                        }else{
                            \RedeSocial\Utilidades::alerta('Email ou senha inválidos');
                            \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
                        }
                    }
                }
                \RedeSocial\Views\MainView::render('login');
            }
        }
    }
?>