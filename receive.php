<?php
session_start();

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
@socket_connect($socket, '127.0.0.1', 8080);
@socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec"=>10,"usec"=>0));

$send = 'UPDA?'.sprintf('% 30s', $_SESSION['pseudo']);
@socket_write($socket, $send, 35);

while(true){
	if($content = @socket_read($socket, 999)){
		echo trim($content);
	}else{
		echo "#rien";
	}
	break;
}
?>