document.querySelector('#cantidad').disabled=true;
document.querySelector('#accion').style.display = 'none'


function accion(){

    var tipo= document.querySelector('#tipo').value; 
    var numeroentrada= document.querySelector('#numeroentrada').value; 
    var cantidad= document.querySelector('#cantidad').value;
    var cadena = "tipo="+tipo+"&numeroentrada="+numeroentrada+"&cantidad="+cantidad;

    document.querySelector('#accion').style.display = 'block'
    var solicitud = new XMLHttpRequest();



    solicitud.onreadystatechange= function(){
        if (this.readyState == 4 && this.status == 200){
            var respuesta = JSON.parse(this.responseText);
            var identificador = "#stock-" + respuesta.numero_entrada;
            var celda = document.querySelector(identificador);

            if (respuesta.resultado == "OK"){

                celda.innerHTML = respuesta.cant;

            } else {
                console.log(respuesta.resultado);
            }
          
        }
    };
    solicitud.open("POST", "accion.php",true);
    solicitud.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    solicitud.send(cadena);
 
}


function depositar(numeroentrada){
    
    document.querySelector('#tipo').value= "p";
    document.querySelector('#tipo_accion').innerHTML= "depositar";
    document.querySelector('#numeroentrada').value =numeroentrada;
    document.querySelector('#cantidad').focus(); 
    document.querySelector('#cantidad').disabled=false;
    document.querySelector('#accion').style.display = 'block'

}

function reponer(numeroentrada){
    document.querySelector('#tipo').value= "r";
    document.querySelector('#tipo_accion').innerHTML= "Reponer";
    document.querySelector('#numeroentrada').value =numeroentrada;
    document.querySelector('#cantidad').focus(); 
    document.querySelector('#cantidad').disabled=false;
    document.querySelector('#accion').style.display = 'block'

   
}

