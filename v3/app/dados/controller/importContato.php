<?php
session_start('AgENdA');
if( isset($_SESSION['id']) ) {
	if ( isset($_FILES['arquivo']) || isset($_POST['arquivo']) ) {
		require_once('import.php');
		$contatos = new ImportaContato(
							$_FILES['arquivo']['tmp_name'],
							$_FILES['arquivo']['name'],
							$_FILES['arquivo']['size'],
							$_FILES['arquivo']['type'],
							$_SESSION['id']
						);
		$parametro = "";
		$retorno = "";
		if (isset($_GET['p']) ) {
			$parametro = $_GET['p'];
			if ( $parametro == "tabela" ) {
				$retorno = $contatos->verificar();
			}
			else {
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/formImport.php'>";
			}
		}
		else {
			$retorno = $contatos->executar();
		}
		switch ($retorno) {
			case 0:
				if ($parametro == "tabela") {
					echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
					echo "\n";
					echo '<html xmlns="http://www.w3.org/1999/xhtml">';
					echo "\n<head>\n\t";
					echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
					echo "\n\t<title>Agenda 2.0</title>\n\t";
					echo '<link rel="stylesheet" type="text/css" charset="utf-8" href="../css/estilo.css" />';
					echo "\n\t";
					echo '<link rel="icon" type="image/gif" href="../favicon.gif" />';
					echo "\n";
?>
	<script type="text/javascript">
		alert("Verifique se a ordem e os dados estão na forma desejada.\nSe estiver a formatação do arquivo está correta.");
	</script>
<?php
					echo "</head>\n";
					echo "<body>\n\n";
					echo "<table id='barraNavegacao'>\n";
					echo "<tr>\n\t";
					echo "<td><a href='../view/formImport.php'>Voltar</a></td>\n\t";
					echo "<td class='center'><a name='topo' href='#fim'>FIM</a></td>\n\t";
					echo "<td class='right'><a href='./logout.php'>Logout</a></td>\n";
					echo "</tr>\n";
					echo "</table>\n<br />\n";
					echo $contatos->get("tabela");
					echo "<br />\n";
					echo "<table id='barraNavegacao'>\n";
					echo "<tr>\n\t";
					echo "<td><a href='../view/formImport.php'>Voltar</a></td>\n\t";
					echo "<td class='center'><a name='fim' href='#topo'>TOPO</a></td>\n\t";
					echo "<td class='right'><a href='./logout.php'>Logout</a></td>\n";
					echo "</tr>\n";
					echo "</table>\n<br />\n";
					echo "</body>\n";
					echo "</html>";
				}
				else {
?>
<script charset="utf-8" type="text/javascript">
	alert("Importação efetuada com sucesso!\n<?php echo $contatos->get("numContatos"); ?> contatos importados.");
</script>
<?php
					echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
				}
			break;
			case 1:
?>
<script charset="utf-8" type="text/javascript">
	alert("Tipo de arquivo inválido!\n\nUse um arquivo no padrão CSV.\n\n");
</script>
<?php
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/formImport.php'>";
			break;
			case 2:
?>
<script charset="utf-8" type="text/javascript">
	alert("Arquivo muito grande!");
</script>
<?php
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/formImport.php'>";
			break;
			case 3:
?>
<script charset="utf-8" type="text/javascript">
	alert("Erro ao ler o arquivo!");
</script>
<?php
				echo "<p>ERRO: ".$contatos->get("tryErro")."</p><p>Em caso de erro reporte o código acima ao <a href='mailto:cleberllf@gmail.com'>Administrador do site</a>.</p>";
			break;
			case 4:
?>
<script charset="utf-8" type="text/javascript">
	alert("Número de contatos excede o limite!\nHá <?php echo $contatos->get("numContatos"); ?> contatos.");
</script>
<?php
			break;
			case 5:
?>
<script charset="utf-8" type="text/javascript">
	alert("Erro ao inserir contatos no banco de dados!");
</script>
<?php
				echo "<p>ERRO: ".$contatos->get("tryErro")."</p><p>Em caso de erro reporte o código acima ao <a href='mailto:cleberllf@gmail.com'>Administrador do site</a>.</p>";
			break;
			default:
?>
<script charset="utf-8" type="text/javascript">
	alert("Ocorreu um erro desconhecido!");
</script>
<?php
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/formImport.php'>";
			break;
		}
	}
	else {
		echo "else listar";
		//echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
	}
}
else {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
}
?>