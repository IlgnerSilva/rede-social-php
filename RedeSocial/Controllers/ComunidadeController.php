<?php
	namespace RedeSocial\Controllers;
	class ComunidadeController{
		public function index(){
			if(isset($_SESSION['login'])){
				if(isset($_GET['solicitarAmizade'])){
					$idPara = (int) $_GET['solicitarAmizade'];
					if(\RedeSocial\Models\UsuariosModel::solicitarAmizade($idPara)){
						\RedeSocial\Utilidades::alerta('Amizade solicitada com sucesso!');
						\RedeSocial\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}else{
						\RedeSocial\Utilidades::alerta('Ocorreu um erro ao solicitar a amizade...');
						\RedeSocial\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}
				}

			\RedeSocial\Views\MainView::render('comunidade');
			}else{
				\RedeSocial\Utilidades::redirect(INCLUDE_PATH);
			}
		}
	}
?>