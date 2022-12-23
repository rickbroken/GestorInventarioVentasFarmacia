
let btnIngresar = document.getElementById('ingresar');



function loginUsuario(){
    let peticion = new XMLHttpRequest();

    let campoUsuario = document.getElementById('usuario').value;
    let campoPassword = document.getElementById('password').value;

    campoUsuario = SegString(campoUsuario);
    campoPassword = SegString(campoPassword);
    

    let obj = {
            "usuario" : campoUsuario,
            "password" : campoPassword
        };

        
    let encapsulado = JSON.stringify(obj);

    peticion.open('POST','php/comprobar-usuario.php');

    peticion.onload = ()=>{
        let datos = JSON.parse(peticion.responseText);

        if(datos.error == true){
            console.log('Tienes un error de datos no recibidos');
        } else {
           if(datos.exito == false){
                document.getElementById('p-cont-1').classList.remove('p-cont-1Ocultar');
                document.getElementById('p-cont-1').classList.add('p-contActivo');
                document.getElementById('p-cont-2').classList.remove('p-cont-2Ocultar');
                document.getElementById('p-cont-2').classList.add('p-contActivo');
           } else {
                window.location.replace(ruta + "index.php");
           }
        }
    }

    peticion.setRequestHeader("Content-Type", "application/json");
    peticion.send(encapsulado);

}

let eyePassword = document.getElementById('eyePassword');
let inputPass = document.getElementById('password');
let i = 0;
eyePassword.addEventListener('click',()=>{
    if(i == 1){
        eyePassword.removeAttribute('icon');
        eyePassword.setAttribute('icon','mdi:eye-outline');
        inputPass.removeAttribute('type');
        inputPass.setAttribute('type','password');
        i = 0;
    } else {
        eyePassword.removeAttribute('icon');
        eyePassword.setAttribute('icon','mdi:eye-off-outline');
        i = 1;
        inputPass.removeAttribute('type');
        inputPass.setAttribute('type','text');

    }
});




btnIngresar.addEventListener('click',()=>{
    loginUsuario();
});
