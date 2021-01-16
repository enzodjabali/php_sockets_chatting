<?php
class Server {
	private $_actualClient;
	private $_socket;
	private $_clients;

	public function __construct() {
		$this->_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_bind($this->_socket, "127.0.0.1", 8080);
		socket_listen($this->_socket);

		$this->_clients = array();

		while(true){
			$this->_actualClient = socket_accept($this->_socket);
			Server::work();
		}
	}

	private function work() {
		$entete = socket_read($this->_actualClient, 5);

		if(substr_count($entete, 'JOIN?') > 0){
			$content = socket_read($this->_actualClient, 30);
			$pseudo = trim($content);
			$this->_clients[$pseudo] = $this->_actualClient;
		}
		elseif(substr_count($entete, 'UPDA?') > 0){
			$content = socket_read($this->_actualClient, 30);
			$pseudo = trim($content);
			$this->_clients[$pseudo] = $this->_actualClient;

		}elseif(substr_count($entete, 'SEND?') > 0){
			$content = socket_read($this->_actualClient, 994);
			$message = trim($content);
			Server::send($message);
		}
	}

	private function send($message){
		foreach($this->_clients as $key => $socket){
			if(is_resource($socket)){
				$send = sprintf('% 999s', $message);
				@socket_write($socket, $send, 999);
			}
		}
	}
}
new Server;
?>