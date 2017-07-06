var palabras;

function get_fecha(){
  var d = new Date();
  var ret = d.getDate()+'/'+d.getMonth()+'/'+d.getFullYear();
  return ret;
}

/*function escribir_nuevo_comentario(){
  var n_coment = '<div class="tituloComentario">'+
    '<span class="tituloComentario2">'+
      document.getElementById('f_nombre').value+'. '+ get_fecha() +
    '</span>'+
  '</div>'+
  '<p>'+ document.getElementById('f_text').value +'</p>';

  document.getElementById('nuevo_comentario').innerHTML = n_coment;
}*/

function escribir_comentarios(){
  var todo = document.getElementById('todos').value;
  var usuarioActual = document.getElementById('usuarioActual').value;

  var form2 = '<section id="comentarios">';
  if (todo >= 3) //Por si hay menos de 3 comentarios
    todo = 3;

  //Si hay comentarios en la noticia, se imprimen 3 como mucho
  if(todo>0){
    for(var i=0;i<todo;i++){
        var usuario = document.getElementById('cUsuario'+i).value;
        var texto = document.getElementById('cTexto'+i).value;
        var fecha = document.getElementById('cFecha'+i).value;
        form2 = form2 +
        '<article class="comentarios">'+
          '<div class="tituloComentario">'+
            '<span class="tituloComentario2">'+
              usuario + '. ' + fecha +
            '</span>'+
          '</div>'+
          '<p>' + texto + '</p>'+
        '</article>';
    }
  }

  //El formulario solo se muestra a usuario registrados
  if(usuarioActual!=0){
    var idNoticia = document.getElementById('idNoticia').value;
    form2 = form2 +
      '<section id="formularioComentario">'+
        '<h4>Introduzca un nuevo comentario.</h4>'+
        '<form action="../comun/insertarComentario.php" name="nuevoComentario" method="post">'+
          '<input type="hidden" name="idNoticia" value="'+idNoticia+'">'+
          '<label>Texto Comentario: </label>'+
          '<textarea id="f_text" name="texto" cols="20" rows="10" onKeyUp="palabras_prohibidas()"></textarea>'+
          '<button type="submit">Enviar</button>'+
        '</form>'+
      '</section>';
      palabras = declaraPalabras();
    } else {
      var ruta_actual = document.getElementById('ruta_actualJ').value;
      form2 = form2 +
        '<p>Para dejar un comentario debe iniciar sesion.</p>'+
        '<p>'+
          '<form action="../comun/inicioSesion.php" class="formA" method="POST">'+
            '<input type="hidden" name="rutaClick" value="'+ruta_actual+'"/>'+
            '- <input type="submit" value="Iniciar Sesi&oacute;n"/>'+
          '</form>'+
        '</p>'+
        '<p>'+
          '<form action="../comun/registrarUsuario.php" class="formA" method="POST">'+
            '<input type="hidden" name="rutaClick" value="'+ruta_actual+'"/>'+
            '- <input type="submit" value="Registrate"/>'+
          '</form>'+
        '</p>';
    }

  form2 = form2 +
    '</section>';//#idComentarios

  document.getElementById('contenedor_columnaAux').innerHTML = form2;
}

function declaraPalabras(){
  var totalP = document.getElementById('totalPalabras').value;
  var palabras = [];
  for(var i=0;i<totalP;i++){
    palabras[i] = document.getElementById('palabra'+i).value;
  }
  return palabras;
}

var conjunto = [" ", ",", ".", "/"];
//var palabras = ["hola", "algo", "tres", "pole", "dos", "yuju", "adios", "ocho", "falacia", "diez"];
//var palabras = declaraPalabras();

function palabra_entera(texto, palabra, inicio){
	var fin = inicio+palabra.length;
	var entera1 = false, entera2 = false;

	//alert("Inicio: " + inicio + ", Fin: " + fin);
	//alert("1:" + texto[inicio-1] + ", 2: " + texto[fin])

	//Si lo que hay delante es diferente a cualquiera de conjuntos
	for(i=0; i<conjunto.length && entera1==false;i++){
		if(texto[inicio-1] == conjunto[i])
				entera1 = true;
	}

	//Si lo que hay detras es diferente a cualquiera de conjuntos
	for(x=0;x<conjunto.length && entera2==false;x++){
		if(texto[fin] == conjunto[x])
			entera2 = true;
	}

	//alert ('1: ' + entera1 + "2: " + entera2);
	//Si delante y detras tiene [conjuntos] la palabra seŕa prohibida.
	if(entera1==true && entera2==true)
		return true;
	else
		return false;
}

function palabras_prohibidas(){
  var texto = document.getElementById('f_text').value;
  texto = texto.toLowerCase();

  for(var i=0;i<palabras.length;i++){

    if(texto.search(palabras[i])!=-1){ //Si la palabra está en el texto
		var inicio = texto.search(palabras[i]);
		//alert('Hola ' + inicio + ", " + palabras[i].length);

		if(palabra_entera(texto, palabras[i], inicio)==true){
			for(var j=0;j<palabras[i].length;j++){
				document.getElementById('f_text').value = document.getElementById('f_text').value.substr(0,inicio+j) + "*" + document.getElementById('f_text').value.substr(inicio+j+1);
			}
		}
    }
  }
}
