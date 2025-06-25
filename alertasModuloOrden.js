document.getElementById("DatosContraseña").addEventListener("submit", function(alertar) {
    alertar.preventDefault();

    const contraseñaNueva = document.getElementById("nueva").value; 

    if (!contraseñaNueva) {
        Swal.fire({
            icon: 'warning',
            title: 'Contraseña vacía',
            text: 'Por favor escriba su contraseña',
            confirmButtonColor: '#f39c12'
        });
        return;
    }

    fetch('CambiarContraseña.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            correo: mandarCorreo,
            contraseña: contraseñaNueva
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Contraseña válida',
                html: `
                    <i class="fa-solid fa-envelope-circle-check" style="font-size: 40px; color: #1e3d58;"></i><br><br>
                    ${data.message}<br>
                    Su contraseña fue cambiada con exito
                `,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#f9f9f9',
                background: '#f9f9f9',
                timer: 7000
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Existió un error',
                text: data.message,
                confirmButtonColor: '#8b0000'
            });
        }
    })
    .catch(error => {
        console.error(error);
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo contactar con el servidor.',
            confirmButtonColor: '#8b0000'
        });
    });
});





document.getElementById("formularioCorreo").addEventListener("submit", function(alertar) {
    alertar.preventDefault(); 
    const mandarCorreo = document.getElementById("correo").value;

    if (!mandarCorreo) {
        Swal.fire({
            icon: 'warning',
            title: 'Campo vacío',
            text: 'Por favor escribe tu correo',
            confirmButtonColor: '#f39c12'
        });
        return;
    }

    fetch('MandarCorreo.php', { // ruta de tu archivo PHP
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ correo: mandarCorreo })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Correo enviado',
                html: `
                    <i class="fa-solid fa-envelope-circle-check" style="font-size: 40px; color: #1e3d58;"></i><br><br>
                    ${data.message}<br>
                    Revisa tu bandeja de entrada.
                `,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#8b0000',
                background: '#f9f9f9',
                timer: 7000
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Existio un error',
                text: data.message,
                confirmButtonColor: '#8b0000'
            });
        }
    })
    .catch(error => {
        console.error(error);
        Swal.fire({
            icon: 'error',
            title: 'Error de conexion',
            text: 'No se pudo contactar con el servidor.',
            confirmButtonColor: '#8b0000'
        });
    });
});




document.addEventListener("DOMContentLoaded", function () {
    const botonesEliminar = document.querySelectorAll(".btn-eliminar");

    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", function (e) {
            e.preventDefault();

            const idOrden = this.dataset.id;

            Swal.fire({
                title: '¿Estás seguro de eliminar esta orden?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `eliminarOrden.php?id=${idOrden}`;
                }
            });
        });
    });
});
