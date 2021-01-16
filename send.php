<?php
if(isset($_POST['message']) && !empty($_POST['message'])){
	$messagehtml = htmlspecialchars($_POST['message']);
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_connect($socket, "127.0.0.1", 8080);
	$send = 'SEND?'.sprintf('% 994s', $messagehtml);
	socket_write($socket, $send, 999);
	socket_shutdown($socket, 2);
	socket_close($socket);
	echo 'send';
}
?>