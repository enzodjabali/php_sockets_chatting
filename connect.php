<?php
if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
	$pseudohtml = htmlspecialchars($_POST['pseudo']);
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_connect($socket, "127.0.0.1", 8080);
	$send = 'JOIN?'.sprintf('% 30s', $pseudohtml);
	socket_write($socket, $send, 35);
	socket_shutdown($socket, 2);
	socket_close($socket);
	echo 'connecte';
}
?>