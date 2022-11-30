function agregarSeparadorMiles(numero) {
    let partesNumero = numero.toString().split('.');

    partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    return partesNumero.join('.');
}
function quitarSeparadorMiles(numero) {
    let partesNumero = numero.toString().split('.');

    partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, '');

    return partesNumero.join('');
}

tabla = document.getElementById('tabla');
btn_cargar = document.getElementById('addProducto');
campoValor = document.getElementById('campo').value;
campo = document.getElementById('campo');


function multiplicarinputs(){
    cellTotal = 0;
    for(i=1; i < tabla.rows.length; i++){

        let precio = tabla.rows[i].cells[5].innerHTML;
        precio = quitarSeparadorMiles(precio);
        precio = parseInt(precio);
        
        let inputs = tabla.rows[i].cells[6].children;
        
        
        let valor = "";
        valor = inputs[0].value;
        
        if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 0){
            let subprecio = agregarSeparadorMiles(precio);
            tabla.rows[i].cells[7].innerHTML = subprecio;
            inputs[0].value = valor;
        }
        
        
        if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
            let subprecio = agregarSeparadorMiles(precio);
            tabla.rows[i].cells[7].innerHTML = subprecio;
        } 
        if(inputs[0].value > 0){
            let total = precio * inputs[0].value ;
            
            total = agregarSeparadorMiles(total);

            tabla.rows[i].cells[7].innerHTML = '' + total;
        }
        
        inputs[0].addEventListener('blur',()=>{
            if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
                inputs[0].value = '1';
                let subprecio = agregarSeparadorMiles(precio);
                tabla.rows[i].cells[7].innerHTML = subprecio;
            }
        });

        let precioVenta = tabla.rows[i].cells[7].innerHTML;

        precioVenta = quitarSeparadorMiles(precioVenta);
        
        cellTotal = cellTotal + Number(precioVenta);


//
    }
    let tablaTotal = document.getElementById('table-total');
    
    tablaTotal.rows[0].cells[3].innerHTML = "$ " + agregarSeparadorMiles(cellTotal);

}


function cargarUsuarios(){

    let peticion = new XMLHttpRequest();


    
    let input = document.getElementById('campo').value;

    peticion.open('GET', 'php/leer-datos-caja.php?campo=' + input, true);

    peticion.onload = ()=>{
        let datos = JSON.parse(peticion.responseText);


        if(datos.error == true){
            error_box.classList.add('active');
        } else {
            for(i=0; i < datos.length ; i++){
                let elemento = document.createElement('tr');
                elemento.innerHTML += ("<td>" + datos[i].codigo + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].nombre + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].cantidad + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].vencimiento + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].concentracion + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].precio + "</td>");
                elemento.innerHTML += ("<td><input type='number' min='1' value='1'></input></td>");
                elemento.innerHTML += ("<td>" + datos[i].precio + "</td>");
                document.getElementById('tabla').appendChild(elemento);
            }
        }
    }

    peticion.onreadystatechange = ()=>{
        if(peticion.readyState != 4 && peticion.status != 200){
            console.log('algo salio mal con la conexion');
        }
    }


    peticion.send();
    
}

document.getElementById('formulario').addEventListener('submit',(e)=>{
    e.preventDefault();
});

function validarRepetidos(){
    for(i=0 ; i < tabla.rows.length ; i++){
        let codigo = tabla.rows[i].cells[0].innerHTML;
        
        if(campo.value == codigo){
            console.log('se repitio el valor');
        }
        if (campo.value != codigo) {
            
        }
    }
}
btn_cargar.addEventListener('click', ()=>{
    validarRepetidos();
    cargarUsuarios();
    setInterval(()=>{
        multiplicarinputs();
    },500);
    document.getElementById('campo').value = ""; 
});