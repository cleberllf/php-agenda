function confirma(msg, nome, link, msg2) {
	if ( confirm('Tem certeza que deseja ' + msg + ' "' + nome + '" ?' + msg2) ) {
		location.href = link;
	}
}
