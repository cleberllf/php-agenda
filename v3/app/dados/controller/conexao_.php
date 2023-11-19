<?php

class BancoDeDados {

	private $conexao;
	private $host    = "mysql";
	private $bd      = "bd_agenda";
	private $usuario = "root";
	private $senha   = "Senha123";

	public function __construct() {}

	public function conectar() {
		$this->conexao = mysql_connect($this->host, $this->usuario, $this->senha);
		mysql_select_db($this->bd, $this->conexao);
		
		return $this->conexao;
	}

	public function desconectar() {
		mysql_close($this->conexao);
	}

	public function SQL($sql) {
		$retorno = mysql_query($sql, $this->conexao);
		return $retorno;
	}

	public function resultado($rs, $indice, $campo) {
		$retorno = mysql_result($rs, $indice, $campo);
		return utf8_encode($retorno);
	}

	public function rows($rs) {
		$retorno = mysql_num_rows($rs);
		return $retorno;
	}

	public function inserir($valores, $tabela) {

		// conecta o banco de dados
		$this->conectar();

		// consulta
		$sql = "INSERT INTO
					$tabela
					VALUES ( ";

		// acrescenta no script todos os campos para inserção
		$eof = count($valores)-1;
		for($i=0; $i<count($valores); $i++) {

			$sql .= "'".$valores[$i]."'";

			if($i != $eof) {
				$sql .= ", ";
			}
		}

		// finaliza a consulta
		$sql .= ")";

		// executa a consulta
		$rs = $this->SQL($sql);

		// desconecta o banco de dados
		$this->desconectar();

		// retorna o resultset da consulta
		return $rs;
	}

	public function excluir($id, $campoId, $tabela) {

		// conecta o banco de dados
		$this->conectar();

		// consulta
		$sql = "DELETE FROM
						$tabela
					WHERE
						$campoId = ".$id."
					";

		// executa a consulta
		$rs = $this->SQL($sql);

		// desconecta o banco de dados
		$this->desconectar();

		// retorna o resultset da consulta
		return $rs;
	}

	public function selecionar($campos, $tabela, $where="", $ordena="", $limite="") {

		// conecta o banco de dados
		$this->conectar();

		// consulta
		$sql = "SELECT
						$campos
					FROM
						$tabela
						$where
						$ordena
						$limite
					";

		// executa a consulta
		$rs = $this->SQL($sql);

		// consulta o nome das colunas
		$sql_colunas = "SHOW
								COLUMNS
							FROM
								$tabela
							";

		// executa a consulta do nome das colunas
		$rs_colunas = $this->SQL($sql_colunas);

		// armazenando os campos em um vetor
		$vetor_colunas = array();
		for($j=0; $j<$this->rows($rs_colunas); $j++) {
			$colunas = mysql_fetch_assoc($rs_colunas);
			$vetor_colunas[$j] = $colunas['Field'];
		}

		$vetor = array();
		// listando todos os dados
		for($i=0; $i<$this->rows($rs); $i++) {
			// listando todos os campos possíveis
			for($j=0; $j<$this->rows($rs_colunas); $j++) {
				$vetor[$i][$vetor_colunas[$j]] = $this->resultado($rs, $i, $vetor_colunas[$j]);
			}
		}

		// desconecta o banco de dados
		$this->desconectar();

		// retorna o vetor
		return $vetor;
	}

	public function atualizar($id, $campos, $valores, $tabela) {

		// conecta o banco de dados
		$this->conectar();

		// consulta
		$sql = "UPDATE
						$tabela
					SET
					";

		// acrescenta no script todos os campos para inserção
		$eof = count($valores)-1;
		for($i=0; $i<count($valores); $i++) {
			$sql .= $campos[$i]." = '".$valores[$i]."'";
			//echo "i: ".$i.", eof: ".$eof.", campos: ".$campos[$i].", valores: ".$valores[$i]."<br/>";
			if($i != $eof) {
				$sql .= ", ";
			}
		}

		// finaliza a consulta
		$sql .= " WHERE
						id = $id
					";

		// executa a consulta
		$rs = $this->SQL($sql);

		// desconecta o banco de dados
		$this->desconectar();

		// retorna o resultset da atualização
		return $rs;
	}
}

?>
