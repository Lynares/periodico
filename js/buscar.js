
function comprobarLike(){
  var varLike = document.getElementById('like').value;
  //alert("Hola, "+varLike);
  //document.getElementById("rellena_lista").innerHTML = "<li><a>"+varLike+"</a></li>";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("rellena_lista").innerHTML = this.responseText;
    }
  };

  //xhttp.open("POST", "../comun/buscar.php", true);
  xhttp.open("GET", rutaWeb()+"comun/buscar.php?like="+varLike, true);
  xhttp.send();
}
