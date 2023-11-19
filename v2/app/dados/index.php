<?php
session_start('AgENdA');
if ( isset($_SESSION['id']) ) {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=./view/listar.php'>";
}
else {
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Agenda 2.0</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="./css/estilo.css" />
	<link rel="icon" type="image/gif" href="./favicon.gif" />
	<script charset="utf-8" type="text/javascript">
		function verificar() {
			var user = document.getElementById("txtUser");
			var pass = document.getElementById("txtPass");
			if (user.value=="") {
				alert("Favor digitar o nome do usuário.");
				user.focus();
				return(false);
			}
			if (pass.value=="") {
				alert("Favor digitar a senha.");
				pass.focus();
				return(false);
			}
			return true;
		}
	</script>
</head>

<body>

<h1>AGENDA 2.0</h1>
<br/>

<center>
<form action="./controller/loginUsuario.php" method="post" name="formLogin">
<table id="formLogin">
<tr>
	<th><label for="txtUser">Usuário:</label></th>
	<td><input type="text" name="usuario" id="txtUser" size="20" maxlength="20" /></td>
</tr>
<tr>
	<th><label for="txtPass">Senha:</label></th>
	<td><input type="password" name="senha" id="txtPass" size="20" maxlength="20" /></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="ACESSAR" onclick="javascript:return verificar();" /></td>
</tr>
</table>
</form>
</center>

<h5>Seu IP é: <?= $_SERVER["REMOTE_ADDR"] ?></h5>
</body>
</html>
<?php
}
?>