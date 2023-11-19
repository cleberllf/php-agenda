<?php
session_start('AgENdA');
if ( isset($_SESSION['id']) ) {
	include("../controller/login.php");
	$login = new Autenticacao();
	$vetor = $login->selecionar("*", "agenda_usuarios", " WHERE id = '".$_SESSION['id']."'");
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Agenda 2.0</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="../css/estilo.css" />
	<link rel="icon" type="image/gif" href="../favicon.gif" />
	<script type="text/javascript" charset="utf-8" src="../js/confirma.js"></script>
	<script charset="utf-8" type="text/javascript">
		function verificar () {
			var nome = document.getElementById("txtNome");
			var login = document.getElementById("txtLogin");
			var pass = document.getElementById("txtPass");
			var pass2 = document.getElementById("txtPass2");
			if (nome.value=="") {
				alert("Favor digitar um nome.");
				nome.focus();
				return(false);
			}
			else if ( (pass.value!="") || (pass2.value!="") ) {
				if (pass.value != pass2.value) {
					alert("As senhas não são iguais.");
					if (pass.value == "") {
						pass.focus();
					}
					else if (pass2.value == "") {
						pass2.focus();
					}
					else {
						pass.focus();
					}
					return(false);
				}
			}
			else if ( !confirm("Tem certeza que deseja alterar o usuário?") ) {
				return(false);
			}
			return true;
		}
	</script>
</head>
<body>

<blockquote>
<h2>ADMINISTRAÇÃO</h2>
<h1>EDITAR USUÁRIO</h1>

<form action="../controller/editPerfil.php" method="post" id="formEdit" onsubmit="return verificar();">
<table id="form">
<tr>
	<th><label for="txtNome">Nome:</label></th>
	<td><input type="text" name="nome" id="txtNome" value="<?php echo $vetor[0]['nome']; ?>" size="100" maxlength="100" /></td>
</tr>
<tr>
	<th><label for="txtLogin">Login:</label></th>
	<td><input type="text" readonly="readonly" name="usuario" id="txtLogin" value="<?php echo $vetor[0]['usuario']; ?>" /></td>
</tr>
<tr>
	<th><label for="txtPass">Nova Senha:</label></th>
	<td><input type="password" name="senha" id="txtPass" size="10" maxlength="10" /></td>
</tr>
<tr>
	<th><label for="txtPass2">Repita Nova Senha:</label></th>
	<td><input type="password" name="senha2" id="txtPass2" size="10" maxlength="10" /></td>
</tr>
<tr>
	<th><label for="txtNivel">Nível:</label></th>
	<td>
<?php
	$nivel = $vetor[0]['nivel'];
	if ($nivel==0) {
		$nivel = "Administrador";
	}
	else if ($nivel==1) {
		$nivel = "Usuário Comum";
	}
?>
		<input type="text" readonly="readonly" name="nivel" id="txtNivel" value="<?php echo $nivel; ?>" />
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="ALTERAR" /></td>
</tr>
</table>
</form>
<p>
<a class="red" href="javascript:confirma('excluir a sua', 'conta', '../controller/delPerfil.php?p=del', '')">Excluir</a> minha conta.<br />
Atenção! Esta ação excluirá a sua conta e seus contatos.
</p>
<table id="barraNavegacao">
<tr>
	<td><a href="./listar.php">Voltar</a></td>
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