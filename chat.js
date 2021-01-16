function connect(pseudo){
	var xhr = initXHR();

	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
			if(xhr.responseText === 'connecte'){
				display();
				receiveMessages();
			}
		}
	}

	xhr.open("POST", "connect.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
	xhr.send('pseudo='+encodeURIComponent(pseudo));
}

function initXHR(){
	var xhr = null;

	if(window.XMLHttpRequest || window.ActiveXOject){
		if(window.ActiveXOject){
			try{
				xhr = new ActiveXOject("Msxml2.XMLHTTP");
			}catch(e){
				xhr = new ActiveXOject("Microsoft.XMLHTTP");
			}
		}else{
			xhr = new XMLHttpRequest();
		}
	}else{
		alert("Veuillez changer de navigateur. Certaines parties du site ne s'afficherons pas ou mal");
		return null;
	}
	return xhr;
}

function $(id){
	return document.getElementById(id);
}

function display(){
	var receive = $('receiveMessages'),
	send = $('sendMessages'),
	connect = $('connect');

	receive.style.display = send.style.display = 'block';
	receive.style.border = '1px solid blue';
	send.style.border = '1px solid green';
	connect.style.display = 'none';
}

function receiveMessages(){
	var xhr = initXHR();

	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
			if(!xhr.responseText.match(/#rien/)){
				$('receiveMessages').innerHTML += xhr.responseText+'<br>';
			}
			receiveMessages();
		}
	}

	xhr.open("POST", "receive.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
	xhr.send(null);
}

function send(){
	var message = $('message').value;

	var xhr = initXHR();

	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
			$('receiveMessages').innerHTML += message+'<br>';
		}
	}

	xhr.open("POST", "send.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
	xhr.send('message='+encodeURIComponent(message));
}