<?php
session_start();
if(isset($_POST["pseudo"])){
	$_SESSION["pseudo"] = $_POST["pseudo"];
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Chat en temps réel</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="chat">
		<div id="receiveMessages">
			
		</div>
		<div id="sendMessages">
			<input type="text" id="message">
			<br>
			<input type="button" value="Send" onClick="send();">
		</div>
		<div id="connect">
			<input type="button" name="connect" id="connectButton" value="Connexion" onClick="connect('<?php echo htmlentities($_SESSION['pseudo']); ?>');">
		</div>
	</div>

	<form action="index.php" method="post" id="define">
		<input type="text" name="pseudo">
		<br>
		<input type="submit" value="Define">
	</form>

<script src="chat.js" async></script>
</body>
</html>