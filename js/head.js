/************** HEAD ****************/
	function ruta(){
		var rut="";
		return rut;
	}
	function rutaWeb(){
		return "http://localhost/periodico/";
	}
	function cambiarSeccionIndex(){
		var rtWeb = rutaWeb();
		location.href=rtWeb;
	}
	function compartir(){
		var titulo=document.getElementById('ti').value;
		var imagen=document.getElementById('im').value;
		//alert("Compartir:");// "+titulo+" via @lagranada");
		confirm("Compartir: "+titulo+" via @lagranada \nRuta foto: "+imagen);
	}
/************** FIN-HEAD ****************/
