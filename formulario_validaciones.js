// funcion que ejecuta los mensajes si validaciones no cumples
function mostrarError(input, mensaje) {
    let errorMensaje = input.parentNode.querySelector(".error-mensaje");
    if (!errorMensaje) {
        errorMensaje = document.createElement("p");
        errorMensaje.classList.add("error-mensaje");
        input.parentNode.appendChild(errorMensaje);
    }
    errorMensaje.textContent = mensaje;
}

// funcion que da si la valiacion si esta bien
function estaBien(input) {
    let errorMensaje = input.parentNode.querySelector(".error-mensaje");
    if (errorMensaje) {
        errorMensaje.remove();
    }
}
// fin de la validacion texto

//  formulario 1 si sale de la entrada seejcuta evento
document.addEventListener("DOMContentLoaded", function() {
    const formularioCliente = document.getElementById("DatosOrden");
    const campoDatosOrden = document.querySelectorAll("input, select");

    campoDatosOrden.forEach((entradacampos) => {
        entradacampos.addEventListener("keyup", ValidarFormularioDatos);
        entradacampos.addEventListener("blur", ValidarFormularioDatos);
    });

    formularioCliente.addEventListener("submit", function(e) {
        e.preventDefault();
    });
});

const ValidarFormularioDatos=(orden)=>{
    switch(orden.target.name){
        case "FechaCreacionName":
            let inputValue = orden.target.value;
            if (inputValue.match(/^\d{4}-\d{2}-\d{2}$/)) {
                inputValue += 'T00:00';
            }
            let fechaIngresada = new Date(inputValue);
            let hoy = new Date();
            hoy.setHours(0, 0, 0, 0);
            fechaIngresada.setHours(0, 0, 0, 0);

            if (isNaN(fechaIngresada.getTime())) {
                mostrarError(orden.target, "Debe ingresar una fecha válida");
                estadoCampos.FechaCreacionName = false;
                console.log("mal");
            } 
            else if (fechaIngresada > hoy) {
                mostrarError(orden.target, "La fecha no puede ser futura");
                estadoCampos.FechaCreacionName = false;
                console.log("mal");
            }
            else if (fechaIngresada < hoy) {
                mostrarError(orden.target, "La fecha no puede ser pasada");
                estadoCampos.FechaCreacionName = false;
                console.log("mal");
            } 
            else {
                estaBien(orden.target);
                estadoCampos.FechaCreacionName = true;
                console.log("bien");
            }
            break;

        case "TecnicoName":
            let NombreTrabajador = orden.target.value.trim();
            let letras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

            if (NombreTrabajador===""){
                mostrarError(orden.target, "El nombre del tecnico no puede estar vacio");
                estadoCampos.TecnicoName=false;
                console.log("mal");
            }
            else if (!letras.test(NombreTrabajador)) {
                mostrarError(orden.target, "El nombre del tecnico debe contener letras");
                estadoCampos.TecnicoName = false;
                console.log("mal");
            }
            else if (NombreTrabajador.length < 3) {  
                mostrarError(orden.target, "El nombre del tecnico debe tener mínimo 3 caracteres");
                estadoCampos.TecnicoName= false;
                console.log("mal");
            }
            else {
                estaBien(orden.target);
                estadoCampos.TecnicoName= true;
                console.log("bien");
            }
            break;

        case "CostoTotalName":
            let costoServicios=orden.target.value.trim();
            if (costoServicios==="" || Number(costoServicios)<0){
                mostrarError(orden.target, "El costo total no puede ser vacio, ni ser negativo");
                estadoCampos.CostoTotalName=false;
                console.log("mal");
            }
            else{
                estaBien(orden.target);
                estadoCampos.CostoTotalName=true;
                console.log("bien");
            }
            break;

        case "ClienteName":
            let Nombre = orden.target.value.trim();
            let soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
            if(Nombre===""){
                mostrarError(orden.target, "El nombre del cliente no puede estar vacio");
                estadoCampos.ClienteName = false;
                console.log("mal");
            }
            else if (!soloLetras.test(Nombre)) {
                mostrarError(orden.target, "El nombre solo debe contener letras");
                estadoCampos.ClienteName = false;
                console.log("mal");
            }
            else if (Nombre.length < 3) {  
                mostrarError(orden.target, "El nombre debe tener mínimo 3 caracteres");
                estadoCampos.ClienteName= false;
                console.log("mal");
            }
            else {
                estaBien(orden.target);
                estadoCampos.ClienteName= true;
                console.log("bien");
            }
            break;

        case "IdClienteName":
            let IdCliente = orden.target.value.trim();
            if(IdCliente ===""|| IdCliente<0 ){
                mostrarError(orden.target, "El id del cliente no puede estar vacio");
                estadoCampos.IdClienteName=false;
                console.log("mal");
            } 
            else{
                estaBien(orden.target);
                estadoCampos.IdClienteName=true;
                console.log("bien");
            }
            break;
    }
};

// Codigo formulario datos de la orden 
document.addEventListener("DOMContentLoaded", function()  {
    const datosCarro = document.getElementById("datosCarro");
    const entradas = document.querySelectorAll("input, select");

    // codigo tomamos id del formulario de datos de la orden  y se realiza evento
    entradas.forEach((entradacampos) => {
        entradacampos.addEventListener("keyup", ValidarFormularioCarro);
        entradacampos.addEventListener("change", ValidarFormularioCarro);
        entradacampos.addEventListener("blur", ValidarFormularioCarro);
    });
    DatosOrden.addEventListener("submit", function (orden) {
        orden.preventDefault();
    });
});

// misma logica y mismas validaciones aplicadas al formulario de datos del carro 
const ValidarFormularioCarro = (e) => {
    switch (e.target.name){
        case "VehiculoName":
            let vehiculo = e.target.value;
            let campoPermitido = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
            if(vehiculo===""){
                mostrarError(e.target, "El nombre del vehiculo no puede estar vacio");
                estadoCampos.VehiculoName = false;
                console.log("mal");
            }
            else if (!campoPermitido.test(vehiculo)) {
                mostrarError(e.target, "El nombre del vehiculo solo debe contener letras");
                estadoCampos.VehiculoName = false;
                console.log("mal");
            }
            else if (vehiculo.length < 3) {  
                mostrarError(e.target, "El nombre del vehiculo debe tener minimo 3 letras");
                estadoCampos.VehiculoName= false;
                console.log("mal");
            } else {
                estaBien(e.target);
                estadoCampos.VehiculoName= true;
                console.log("bien");
            }
            break;

        case "ModeloName":
            let valorModelo = e.target.value; 
            if(valorModelo===""){
                mostrarError(e.target, "El modelo no puede estar vacio");
                estadoCampos.ModeloName= false;
                console.log("mal");
            }
            else if (valorModelo.length < 3) {  
                mostrarError(e.target, "El modelo debe tener minimo 3 digitos");
                estadoCampos.ModeloName= false;
                console.log("mal");
            }
            else {
                estaBien(e.target);
                estadoCampos.ModeloName= true;
                console.log("bien");
            }
            break; 

        case "ColorName":
            let color=e.target.value;
            let campoLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
            if(color===""){
                mostrarError(e.target, "El color no puede estar vacio");
                estadoCampos.ColorName= false;
                console.log("mal");
            }
            else if (!campoLetras.test(color)) {
                mostrarError(e.target, "El color solo debe contener letras");
                estadoCampos.ColorName = false;
                console.log("mal");
            }
            else if(color.length < 3){
                mostrarError(e.target, "El nombre del color no puede ser menor a 3");
                estadoCampos.ColorName = false;
                console.log("mal");
            }
            else{
                estaBien(e.target);
                estadoCampos.ColorName= true;
                console.log("bien");
            }
        break;

        case "PlacaName":
            let Placas = e.target.value.trim(); 
            if (Placas === "" || Placas.length < 6) {  
                mostrarError(e.target,"La placa debe de ingresarse y tener minimo 6 digitos ");
                estadoCampos.PlacaName= false;
                console.log("mal");
            } else {
                estaBien(e.target);
                estadoCampos.PlacaName= true;
                console.log("bien");
            }
        break;

        case "KilometrajeName":
            let kilometraje = e.target.value.trim(); 
            if (kilometraje === "" || kilometraje<0) {  
                mostrarError(e.target," El kilometraje debe ingresarse ");
                estadoCampos.KilometrajeName= false;
                console.log("mal");
            } else {
                estaBien(e.target);
                estadoCampos.KilometrajeName= true;
                console.log("bien");
            }
        break;        

        case "GasolinaName":
            let gasolina = e.target.value.trim(); 
            if (gasolina === "" || gasolina<0) {  
                mostrarError(e.target," La gasolina debe ingresarse ");
                estadoCampos.GasolinaName= false;
                console.log("mal");
            } else {
                estaBien(e.target);
                estadoCampos.GasolinaName= true;
                console.log("bien");
            }
        break;             
    }
};

// Inicio de las validaciones de los campo de descripcion 1 
document.addEventListener("DOMContentLoaded", function() {
    const formularioDescripcion = document.getElementById("FormularioDescripcion");
    const campoDescripcion = document.getElementById("descripcion"); 

    campoDescripcion.addEventListener("keyup", ValidarDescripcionVehiculo);
    campoDescripcion.addEventListener("blur", ValidarDescripcionVehiculo);

    formularioDescripcion.addEventListener("submit", function(e) {
        e.preventDefault();
        ValidarDescripcionVehiculo({ target: campoDescripcion }); 
    });
});

const ValidarDescripcionVehiculo = (e) => {
    const descripcion = e.target.value.trim();
    if (descripcion === "" || descripcion.length < 10) {
        mostrarError(e.target, "La descripción debe tener mínimo 10 caracteres.");
        estadoCampos.DescripcionVehiculo = false;
        console.log("mal");
    } else {
        estaBien(e.target);
        estadoCampos.DescripcionVehiculo = true;
        console.log("bien");
    }
};

// Inicio de las validaciones de los campo de descripcion 2
document.addEventListener("DOMContentLoaded", function() {
    const FormularioServicios = document.getElementById("FormularioServicios");
    const camposervicios = document.getElementById("servicios"); 

    camposervicios.addEventListener("keyup", validarServiciosDescripcion);
    camposervicios.addEventListener("blur", validarServiciosDescripcion);

    FormularioServicios.addEventListener("submit", function(e) {
        e.preventDefault();
        validarServiciosDescripcion({ target: camposervicios }); 
    });
});

const validarServiciosDescripcion = (e) => {
    const descripcion = e.target.value.trim();
    if (descripcion === "" || descripcion.length < 10) {
        mostrarError(e.target, "La descripción de servicios debe tener mínimo 10 caracteres.");
        estadoCampos.DescripcionServicios  = false;
        console.log("mal");
    } else {
        estaBien(e.target);
        estadoCampos.DescripcionServicios  = true;
        console.log("bien");
    }
};

// Objeto de estado de los campos
const estadoCampos = {
    FechaCreacionName: false,
    TecnicoName: false,
    CostoTotalName: false,
    ClienteName: false,
    IdClienteName: false,
    VehiculoName: false,
    ModeloName: false,
    ColorName: false,
    PlacaName: false,
    KilometrajeName: false,
    GasolinaName: false,
    DescripcionVehiculo: false,
    DescripcionServicios: false
};

// Validación final antes de enviar el formulario
document.getElementById("formulario_Orden").addEventListener("submit", function(e) {
    e.preventDefault();

    document.querySelectorAll("#formulario_Orden input, #formulario_Orden select, #formulario_Orden textarea").forEach((campo) => {
        const eventoFalso = { target: campo };
        if (campo.name in estadoCampos) {
            if (campo.closest("#datosCarro")) {
                ValidarFormularioCarro(eventoFalso);
            } else if (campo.closest("#DatosOrden")) {
                ValidarFormularioDatos(eventoFalso);
            } else if (campo.id === "descripcion") {
                ValidarDescripcionVehiculo(eventoFalso);
            } else if (campo.id === "servicios") {
                validarServiciosDescripcion(eventoFalso);
            }
        }
    });

    const campos = Object.values(estadoCampos).every(valor => valor === true);

    if (campos === true) {
        Swal.fire({
            title: "Formulario Orden De Trabajo",
            background: "#ffffff",
            allowOutsideClick: false,
            stopKeydownPropagation: false,
            text: "La orden de trabajo fue guardada con éxito",
            icon: 'success',
        }).then(() => {
            document.getElementById("formulario_Orden").submit();
        });
    } else {
        Swal.fire({
            title: "Formulario Orden De Trabajo",
            background: "#ffffff",
            allowOutsideClick: false,
            stopKeydownPropagation: false,
            text: "La orden de trabajo no fue guardada con éxito. Revise todos los campos.",
            icon: 'error',
        });
    }
});
