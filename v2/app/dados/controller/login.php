<?php
require_once('conexao.php');

class Autenticacao extends BancoDeDados {

	private $id;
	private $usuario;
	private $senha;
	private $nome;
	private $nivel;
	private $tabela = "agenda_usuarios";

	public function __construct() {}

	public function autenticar($sessao) {
		// conecta com o banco de dados
		//$this->conectar();

		// prepara os dados recebidos do usuário
		$usuario = $this->get("usuario");
		$senha	= $this->get("senha");
		$senha	= md5($senha);

		// consulta
		$vetor = $this->selecionar("*", $this->tabela, "WHERE usuario = '".$usuario."' AND senha = '".$senha."'");
		$retorno = "";

		// testa se o usuário pode acessar
		if( !empty($vetor) ) {
			$retorno = true;

			// armazena o nome para depois registrar na sessao
			$this->set("id",$vetor[0]['id']);
			$this->set("nome",$vetor[0]['nome']);
			$this->set("usuario",$vetor[0]['usuario']);
			$this->set("nivel",$vetor[0]['nivel']);
			session_register($sessao);
			$_SESSION['id']			= $this->get("id");
			$_SESSION['nome']		= $this->get("nome");
			$_SESSION['usuario']= $this->get("usuario");
			$_SESSION['nivel']	= $this->get("nivel");
		}
		else {
			$retorno = false;
		}

		// desconecta do banco de dados
		//$this->desconectar();

		// retorno booleano
		return $retorno;
	}

	public function get($campo) {
		return $this->{$campo};
	}

	public function set($campo, $valor) {
		$this->{$campo} = $valor;
	}

	public function sair($sessao) {
		session_start($sessao);
		session_destroy();
	}
}

?>