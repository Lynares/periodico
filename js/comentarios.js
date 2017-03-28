function get_fecha(){
  var d = new Date();
  var ret = d.getHours()+':'+d.getMinutes()+' '+d.getDate()+'/'+d.getMonth()+'/'+d.getFullYear();
  return ret;
}

function escribir_nuevo_comentario(){
  var n_coment = '<div class="tituloComentario">'+
    '<span class="tituloComentario2">'+
      document.getElementById('f_nombre').value+'. '+ get_fecha() +
    '</span>'+
  '</div>'+
  '<p>'+ document.getElementById('f_text').value +'</p>';
  //return n_coment;
  document.getElementById('nuevo_comentario').innerHTML = n_coment;
}

function escribir_comentarios(){
  var form2 = '<section id="comentarios">'+
    '<article class="comentarios">'+
      '<div class="tituloComentario">'+
        '<span class="tituloComentario2">'+
          'Pepe. 17:05 18/1/2017'+
        '</span>'+
      '</div>'+
      '<p>Este es el texto del primer comentario.</p>'+
    '</article>'+
    '<article class="comentarios">'+
      '<div class="tituloComentario">'+
        '<span class="tituloComentario2">'+
          'Juan. 18:34 10/3/2017'+
        '</span>'+
      '</div>'+
      '<p>Este es el texto del segundo comentario, mas largo para ver diferencias.</p>'+
    '</article>'+
    '<article class="comentarios" id="nuevo_comentario">'+
    '</article>'+
    '<section id="formularioComentario">'+
      '<h4>Introduzca un nuevo comentario.</h4>'+
      '<form action="" name="nuevoComentario" method="post">'+
        '<label>Nombre: </label>'+
        '<input type="text" id="f_nombre" name="nombre"/>'+
        '<label>E-mail: </label>'+
        '<input type="email" id="f_email" name="email"/>'+
        '<label>Texto Comentario: </label>'+
        '<textarea id="f_text" cols="20" rows="10" onKeyUp="palabras_prohibidas()"></textarea>'+
        '<button type="button" onclick="escribir_nuevo_comentario()">'+
            'Enviar'+
        '</button>'+
      '</form>'+
    '</section>'+
  '</section>';
  //return form2;
  document.getElementById('contenedor_columnaAux').innerHTML = form2;
}

//var palabras = ["Hola", "hola", "Algo", "algo", "Tres", "tres"];
var palabras = ["hola", "algo", "tres", "pole", "dos", "yuju", "adios", "ocho", "falacia", "diez"];

function palabras_prohibidas(){
  var texto = document.getElementById('f_text').value;
  texto = texto.toLowerCase();
  for(var i=0;i<palabras.length;i++){
    if(texto.search(palabras[i])!=-1){ //Si la palabra está en el texto
      var inicio = texto.search(palabras[i]);
      //alert('Hola ' + inicio + ", " + palabras[i].length);
      for(var j=0;j<palabras[i].length;j++){
        document.getElementById('f_text').value = document.getElementById('f_text').value.substr(0,inicio+j) + "*" + document.getElementById('f_text').value.substr(inicio+j+1);
      }
    }
  }
}
