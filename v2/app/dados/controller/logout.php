<?php
require('login.php');
$login = new Autenticacao;
$login->sair('AgENdA');
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
?>