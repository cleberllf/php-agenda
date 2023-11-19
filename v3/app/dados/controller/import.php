<?php
require_once('login.php');

class ImportaContato extends Autenticacao {

private $arqServer;
private $arqUser;
private $arqSize;
private $arqType;
private $userId;
private $numContatos;
private $erro;
private $tabela;

/* Códigos de erro:
* 0 = Sem erro
* 1 = Tipo de arquivo inválido
* 2 = Arquivo muito grande
* 3 = Erro ao ler o arquivo
* 4 = Número de contatos excede o limite
* 5 = Erro relacionado ao banco de dados
* 6 = Erro indefinido
*/

public function get($campo) {
	return $this->{$campo};
}

public function __construct($arqServer,$arqUser,$arqSize,$arqType,$userId) {
	$this->arqServer = $arqServer;
	$this->arqUser = $arqUser;
	$this->arqSize = $arqSize;
	$this->arqType = $arqType;
	$this->userId = $userId;
}

public function executar() {
	if (!strpos($this->arqUser, ".csv")) {
		return 1;
	}
	else if (!($this->arqSize < 30000)) {
		return 2;
	}
	else if (is_uploaded_file($this->arqServer)) {
		try {
			$texto = fopen($this->arqServer,'rt');
			$linhas = fread($texto, filesize($this->arqServer));
			fclose($texto);
			$linhas = str_replace("\n", ",", $linhas);
			$linhas = explode(",",$linhas);
			$this->numContatos = count($linhas)/3;
			if ($this->numContatos < 401) {
				try{
					$tabela = "agenda_contatos";
					for ($i = 0; $i<count($linhas); $i+=3) {
						$valores = array("", $this->userId, $linhas[$i], $linhas[$i+1], $linhas[$i+2]);
						$this->inserir($valores, $tabela);
						if (mysqli_errno()>0) {
							$this->erro = mysqli_errno();
							return 5;
							break;
						}
					}
					return 0;
				}
				catch (Exception $e) {
					$this->erro = $e;
					return 5;
				}
			}
			else {
				return 4;
			}
		}
		catch (Exception $e ) {
			$this->erro = $e;
			return 3;
		}
	}
	else {
		return 6;
	}
}

public function verificar() {
	if (!strpos($this->arqUser, ".csv")) {
		return 1;
	}
	else if (!($this->arqSize < 30000)) {
		return 2;
	}
	else if (is_uploaded_file($this->arqServer)) {
		try {
			$texto = fopen($this->arqServer,'rt');
			$linhas = fread($texto, filesize($this->arqServer));
			fclose($texto);
			$linhas = str_replace("\n", ",", $linhas);
			$linhas = explode(",",$linhas);
			$this->numContatos = count($linhas)/3;
			$tabela = "<table width='100%' border='0'>\n<tr>\n\t<th>Índice</th>\n\t<th>Nome</th>\n\t<th>Telefone</th>\n\t<th>Celular</th>\n</tr>\n";
			$inicio = "<tr>\n\t<td align='center'>";
			$quebra = "</td>\n\t<td align='center'>";
			$fim = "</td>\n</tr>\n";
			for ($i = 0; $i<count($linhas); $i+=3) {
				$index = ($i/3)+1;
				$tabela .= utf8_encode($inicio.
					$index.
					$quebra.
					$linhas[$i].
					$quebra.
					$linhas[$i+1].
					$quebra.
					$linhas[$i+2].
					$fim);
			}
			$tabela .= "</table>\n";
			$this->tabela = $tabela;
			return 0;
		}
		catch (Exception $e ) {
			$this->erro = $e;
			return 3;
		}
	}
	else {
		return 6;
	}
}

}
?>