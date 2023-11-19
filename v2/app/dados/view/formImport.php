<?php
session_start('AgENdA');
if ( isset($_SESSION['id']) ) {
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Agenda 2.0</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="../css/estilo.css" />
	<link rel="icon" type="image/gif" href="../favicon.gif" />
	<script charset="utf-8" type="text/javascript">
		function verificar() {
			form = document.getElementById("formImport");
			if (document.getElementById("arquivo").value == "") {
				alert("Favor selecionar um arquivo!");
				return(false);
			}
			if(document.pressed == "IMPORTAR") {
				form.action ="../controller/importContato.php";
				return(true);
			}
			else if(document.pressed == "Verificar") {
				form.action ="../controller/importContato.php?p=tabela";
				return(true);
			}
		}
	</script>
</head>

<body>

<blockquote>
<h2>IMPORTAR CONTATOS</h2>


<form name="formImport" id="formImport" enctype="multipart/form-data" onsubmit="return verificar();" action="#" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
<table id="form">
	<tr><th><label for="arquivo">Escolha o arquivo de importação:</label></th></tr>
<tr>
	<td><input name="arquivo" id="arquivo" type="file" /></td>
</tr>
<tr>
	<td>
		<input type="submit" name="submit" value="IMPORTAR" onclick="document.pressed = this.value" />
		<input type="submit" name="submit" value="Verificar" onclick="document.pressed = this.value" />
	</td>
</tr>
</table>
</form>
<u></u><br/>
<b>O arquivo deve:</b>
<ul>
	<li>Ser menor que 30kB.</li>
	<li>Ter extensão de arquivo CSV (Comma-Separated Values ou Valores Separados por Vírgulas).</li>
	<li>Ter um contato por linha.</li>
	<li>Estar no padrão:<br/><i>Nome,Telefone,Celular</i><br/>Caso o contato não tenha telefone ou celular deixe o campo em branco, mas coloque as vírgulas.<br/>Ex.:<br/><i>Nome,Telefone,</i><br/>ou<br/><i>Nome,,Celular</i></li>
	<li>Ter no máximo 400 contatos.</li>
</ul>

<br/>
<table id="barraNavegacao">
<tr>
	<td><a href="formAddContato.php">Voltar</a></td>
	<td class="right"><a href="../controller/logout.php">Logout</a></td>
</tr>
</table>

</blockquote>

</body>
</html>
<?php
}
else {
?>
<script charset="utf-8" type="text/javascript">
	alert('Necessário login para acessar esta página.');
</script>
<?php
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
}
?>